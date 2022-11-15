<?php 


 namespace App\OpenApi;

 use ApiPlatform\OpenApi\Model\RequestBody;
 use ArrayObject;
 use ApiPlatform\OpenApi\Model\Components;
 use ApiPlatform\OpenApi\Model\PathItem;
 use ApiPlatform\Core\OpenApi\Model\Operation;
 use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface; 
 use ApiPlatform\core\OpenApi\OpenApi; 
  
 class OpenApiFactory implements OpenApiFactoryInterface { 

    public function __construct(OpenApiFactoryInterface $decorated) { 
        $this->decorated = $decorated; 
    }      
    
    public function __invoke(array $context = []): OpenApi {

        $openApi = $this->decorated->__invoke($context);
        
        /** @var pathItem $path */   
        foreach($openApi->getPaths()->getPaths() as $key =>$path) {
            if($path->getGet() && $path->getGet()->getSummary() === 'hidden') {

                $openApi->getPaths()->addPath($key, $path->withGet(null));
            }
        };
        $openApi->getPaths()->addPath('/ping', new pathItem(null, 'ping', null, new Operation ('ping-id', [], [],'Répond'))); 
        
            
    

        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['bearerAuth'] = new ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT'
        ]);

        $schemas = $openApi-> getComponents()->getSchemas();
        $schemas['Credentials'] = new ArrayObject([
            'type'=>'object',
            'properties'=> [
                'username'=> [
                    'type'=> 'string',
                    'example'=> 'aptest2@ap.com',
                ],
                'password'=> [
                    'type'=> 'string',
                    'example'=>'1111'
                ]
            ]
        ]);


        // $pathItem = new PathItem(
        //     'post', new Operation(
        //         'operationId', 'postApiLogin',
        //         'tags', ['User'],
        //         'requestBody', new requestBody(
        //             'content', new ArrayObject([
        //                 'application/json' => [
        //                     'schema' => [
        //                         '$ref' => '#/components/schemas/Credentials'
        //                     ]
        //                 ]
        //             ])
        //         ),
        //         'responses', [
        //             '200' =>[
        //                 'description','Utilisateur connecté',
        //                 'content'=>[
        //                     'application/json'=> [
        //                         'schema' =>[
        //                             '$ref'=> '#/components/schemas/User-read.User'
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]    
        //     )
        // );




        $pathItem = new PathItem(null, 'Auth', null, new Operation ('Auth-id', ['User'], [],'connect'));
        $openApi->getPaths()->addPath('/api/login', $pathItem);

        return $openApi;
    } 
} 