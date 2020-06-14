<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\UploadService;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * Normally, you'd expect a $id argument to [show(), edit(), delete()]. Instead, by creating
 * a new argument ($product) and type-hinting it with the Product class (which
 * is a Doctrine entity), the ParamConverter automatically queries for
 * an object whose $id property matches the {id} value. It will also
 * show a 404 page if no Product can be found.
 * https://symfony.com/doc/current/best_practices/controllers.html
 * @package App\Controller
 * @Route("/product")
 */
class ProductController extends AbstractController
{

    /**
     * @Route("/", methods={"GET"})
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/new", methods={"GET","POST"})
     * @param Request $request
     * @param UploadService $uploadService
     * @return Response
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);  //Sync form sended data with entity

        //Check if form data is sended
        if ($form->isSubmitted() && $form->isValid()) {

            //Upload image file
            $imageName = $uploadService->upload($form->get('file'));
            $product->setImage($imageName);

            //Save product in DB
            $this->manager->persist($product);
            $this->manager->flush();

            //Create a success html bootstrap notification in response
            $this->sendNotification("Your product [$product] has been created.", 'success');

            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id":"\d+"}))
     * @param Product|null $product
     * @return Response
     * @throws EntityNotFoundException
     */
    public function show(Product $product = null): Response
    {
        //Throw exception if product cannot be found
        if ($product === null) {
            $this->throwEntityNotFound();
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", methods={"GET","POST"}, requirements={"id":"\d+"})))
     * @param Request $request
     * @param Product|null $product
     * @param UploadService $uploadService
     * @return Response
     * @throws EntityNotFoundException
     */
    public function edit(Request $request, UploadService $uploadService, Product $product = null): Response
    {
        //Throw exception if product cannot be found
        if ($product === null) {
            $this->throwEntityNotFound();
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request); //Sync form sended data with entity

        //Check if form data is sended
        if ($form->isSubmitted() && $form->isValid()) {
            $formFile = $form->get('file');

            // this condition is needed because the 'file' field is not required
            // so the images file must be processed only when a file is uploaded
            if ($formFile->getData()) {
                $imageName = $uploadService->upload($formFile);
                $product->setImage($imageName);
            }

            $this->manager->flush();

            //Create a success html bootstrap notification in response
            $this->sendNotification("Your product [$product] has been updated.", 'success');

            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id":"\d+"})))
     * @param Request $request
     * @param Product|null $product
     * @return Response
     * @throws EntityNotFoundException
     */
    public function delete(Request $request, Product $product = null): Response
    {
        //Throw exception if product cannot be found
        if ($product === null) {
            $this->throwEntityNotFound();
        }

        //Check if token sended is valid
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $this->manager->remove($product);
            $this->manager->flush();

            //Create a success html bootstrap notification in response
            $this->sendNotification("Your product [$product] has been deleted.", 'success');

        }

        return $this->redirectToRoute('app_product_index');
    }
}
