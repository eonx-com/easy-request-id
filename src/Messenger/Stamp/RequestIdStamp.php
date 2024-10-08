<?php
declare(strict_types=1);

namespace EonX\EasyRequestId\Messenger\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;

final readonly class RequestIdStamp implements StampInterface
{
    public function __construct(
        private ?string $correlationId = null,
        private ?string $requestId = null,
    ) {
    }

    public function getCorrelationId(): ?string
    {
        return $this->correlationId;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
