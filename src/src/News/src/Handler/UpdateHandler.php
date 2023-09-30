<?php

declare(strict_types=1);

namespace News\Handler;

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\JsonResponse;
use News\Contract\NewsServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class UpdateHandler implements RequestHandlerInterface
{

    public function __construct(
        private readonly NewsServiceInterface $newsService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $this->newsService->update(Uuid::fromString($id), $data);
        return new JsonResponse([], StatusCodeInterface::STATUS_OK);
    }
}