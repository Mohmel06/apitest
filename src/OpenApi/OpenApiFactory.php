<?php #}
/*  */
/*  */
/*  namespace App\OpenApi; */
/*    */
/*  use ApiPlatform\Core\OpenApi\Model\Operation; */
/*  use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;  */
/*  use ApiPlatform\core\OpenApi\OpenApi;  */
/*    */
/*  class OpenApiFactory implements OpenApiFactoryInterface {  */
/*  */
/*     public function __construct(OpenApiFactoryInterface $decorated) {  */
/*     }       */
/*      */
/*     public function __invoke(array $context = []): OpenApi { */
/*  */
/*         $openApi = $this->decorated->__invoke($context); */
/*          /** @var pathItem $path */ 
/*         foreach($openApi->getPaths()->getPaths() as $key =>$path) { */
/*             if($path->getGet() && $path->getGet()->getSummary() === 'hidden') { */
/*                 $openApi->getPaths()->addPath($key, $path->withGet(null)); */
/*             } */
/*         }; */
/*         $openApi->getPaths()->addPath('/ping', new pathItem(null, 'ping', null, new Operation   *//* ('ping-id', [], [], 'Répond')));  */
/*         return $openApi; */
/*              */
/*     } */
/*       */
/* }  */