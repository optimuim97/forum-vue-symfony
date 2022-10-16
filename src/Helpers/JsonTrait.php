<?php 

namespace App\Helpers;

use Symfony\Component\HttpFoundation\JsonResponse;

trait JsonTrait{
  /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     */
    public function jsonTrait($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($this->container->has('serializer')) {
            $json = $this->container->get('serializer')->serialize($data, 'json', array_merge([
                'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            ], $context));

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }
}
