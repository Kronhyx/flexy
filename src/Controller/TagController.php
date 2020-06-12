<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @package App\Controller
 * @Route("/tag")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($tag);
            $this->manager->flush();

            return $this->redirectToRoute('app_tag_index');
        }

        return $this->render('tag/new.html.twig', [
            'tag'  => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id":"\d+"})))
     * @param Tag $tag
     * @return Response
     * @throws EntityNotFoundException
     */
    public function show(Tag $tag = null): Response
    {
        if ($tag === null) {
            $this->throwEntityNotFound();
        }

        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    /**
     * @Route("/{id}/edit", methods={"GET","POST"}, requirements={"id":"\d+"})))
     * @param Request $request
     * @param Tag $tag
     * @return Response
     * @throws EntityNotFoundException
     */
    public function edit(Request $request, Tag $tag = null): Response
    {
        if ($tag === null) {
            $this->throwEntityNotFound();
        }
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('app_tag_index');
        }

        return $this->render('tag/edit.html.twig', [
            'tag'  => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id":"\d+"})))
     * @param Request $request
     * @param Tag $tag
     * @return Response
     * @throws EntityNotFoundException
     */
    public function delete(Request $request, Tag $tag = null): Response
    {
        if ($tag === null) {
            $this->throwEntityNotFound();
        }

        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $this->manager->remove($tag);
            $this->manager->flush();
        }

        return $this->redirectToRoute('app_tag_index');
    }
}
