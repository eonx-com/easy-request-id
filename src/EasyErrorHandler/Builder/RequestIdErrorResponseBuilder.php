<?php
declare(strict_types=1);

namespace EonX\EasyRequestId\EasyErrorHandler\Builder;

use EonX\EasyErrorHandler\Common\Builder\AbstractErrorResponseBuilder;
use EonX\EasyErrorHandler\Common\Provider\ErrorResponseBuilderProviderInterface;
use EonX\EasyRequestId\Common\Provider\RequestIdProviderInterface;
use Throwable;

final class RequestIdErrorResponseBuilder extends AbstractErrorResponseBuilder implements
    ErrorResponseBuilderProviderInterface
{
    public function __construct(
        private readonly RequestIdProviderInterface $requestIdProvider,
        ?int $priority = null,
    ) {
        parent::__construct($priority);
    }

    public function buildHeaders(Throwable $throwable, ?array $headers = null): ?array
    {
        $headers ??= [];
        $headers[$this->requestIdProvider->getCorrelationIdHeaderName()] = $this->requestIdProvider->getCorrelationId();
        $headers[$this->requestIdProvider->getRequestIdHeaderName()] = $this->requestIdProvider->getRequestId();

        return parent::buildHeaders($throwable, $headers);
    }

    /**
     * @return iterable<\EonX\EasyErrorHandler\Common\Builder\ErrorResponseBuilderInterface>
     */
    public function getBuilders(): iterable
    {
        yield $this;
    }
}
