<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/ajax/comment', name: 'comment_add')]
    public function add(Request $request, ArticleRepository $articleRepository, CommentRepository $commentRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $commentData = $request->request->all('comment');

        if(!$this->isCsrfTokenValid('comment-add', $commentData['_token'])){
            return $this->json([
                'code' => 'INVALID_CSRF_TOKEN',
            ], Response::HTTP_BAD_REQUEST);
        }

        $article = $articleRepository->findOneBy(['id' => $commentData['article']]);

        IF(!$article){
            return $this->json([
                'code' => 'ARTICLE_NOT_FOUND'
            ], Response::HTTP_BAD_REQUEST);
        }

        $comment = new Comment($article);
        $comment->setContent($commentData['content']);
        $comment->setUser($userRepository->findOneBy(['id' => 1]));
        $comment->setCreatedAt(new \DateTime());

        $entityManager->persist($comment);
        $entityManager->flush();

        $html = $this->renderView('comment/index.html.twig', [
            'comment' => $comment
        ]);

        return $this->json([
            'code' => 'COMMENT_ADDED_SUCCESSFULLY',
            'messages' => $html,
            'numberOfComments' => $commentRepository->count(['article'=>$article])
        ]);
    }
}
