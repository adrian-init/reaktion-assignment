<?php

namespace App\Helpers;


use App\Exceptions\ThrottleException;
use Illuminate\Contracts\Redis\Factory as Redis;
use Illuminate\Redis\Limiters\DurationLimiter;

/**
 * Class Throttle
 * @package App\Helpers
 */
class Throttle
{
    /**
     * @var Redis
     */
    private $redis;
    /**
     * @var string
     */
    private $key;
    /**
     * @var int
     */
    private $maxAttempts;
    /**
     * @var int
     */
    private $decayMinutes;
    /**
     * The timestamp of the end of the current duration.
     *
     * @var int
     */
    public $decaysAt;

    /**
     * The number of remaining slots.
     *
     * @var int
     */
    public $remaining;

    /**
     * Throttle constructor.
     * @param string $key
     * @param int $maxAttempts
     * @param int $decayMinutes
     */
    public function __construct(string $key, int $maxAttempts, int $decayMinutes = 1)
    {
        $this->redis = app(Redis::class);
        $this->key = $key;
        $this->maxAttempts = $maxAttempts;
        $this->decayMinutes = $decayMinutes;
    }

    /**
     * @return mixed
     * @throws new ThrottleException
     */
    public function attempt()
    {
        if ($this->tooManyAttempts($this->key, $this->maxAttempts, $this->decayMinutes)) {
            throw new ThrottleException(
                'Too Many Attempts'
            );
        }

        return $this->calculateRemainingAttempts();
    }

    public function calculateRemainingAttempts(): int
    {
        return $this->remaining;
    }

    protected function tooManyAttempts(string $key, int $maxAttempts, $decayMinutes): bool
    {
        $limiter = new DurationLimiter(
            $this->redis, $key, $maxAttempts, $decayMinutes * 60
        );

        return tap(! $limiter->acquire(), function () use ($limiter) {
            [$this->decaysAt, $this->remaining] = [
                $limiter->decaysAt, $limiter->remaining,
            ];
        });
    }
}
