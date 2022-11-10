<?php #}
/*  */
/* namespace App\Controller; */
/*  */
/* use App\Repository\PostRepository; */
/*  */
/* class PostCountController */
/* { */
/*  */
/*     public function __construct(PostRepository $postRepository) { */
/*  */
/*     } */
/*  */
/*     public function __invoke(Request $request): int */
/*     { */
/*         $onlineQuery = $request->get('online'); */
/*         $conditions = []; */
/*         if($onlineQuery != null){ */
/*             $conditions = ['online' => $onlineQuery === '1' ? true : false]; */
/*         } */
/*         return $this->postRepository->count($conditions); */
/*     } */
/* } */