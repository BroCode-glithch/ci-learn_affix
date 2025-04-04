<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Shield\Authentication\Traits;

use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\AccessToken;
use CodeIgniter\Shield\Models\UserIdentityModel;
use InvalidArgumentException;
use ReflectionException;

/**
 * Trait HasHmacTokens
 *
 * Provides functionality needed to generate, revoke,
 * and retrieve Personal Access Tokens.
 *
 * Intended to be used with User entities.
 */
trait HasHmacTokens
{
    /**
     * The current access token for the user.
     */
    private ?AccessToken $currentHmacToken = null;

    /**
     * Generates a new personal HMAC token for this user.
     *
     * @param string       $name      Token name
     * @param list<string> $scopes    Permissions the token grants
     * @param Time|null    $expiresAt Expiration date
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public function generateHmacToken(string $name, array $scopes = ['*'], ?Time $expiresAt = null): AccessToken
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        return $identityModel->generateHmacToken($this, $name, $scopes, $expiresAt);
    }

    /**
     * Delete any HMAC tokens for the given key.
     */
    public function revokeHmacToken(string $key): void
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        $identityModel->revokeHmacToken($this, $key);
    }

    /**
     * Revokes all HMAC tokens for this user.
     */
    public function revokeAllHmacTokens(): void
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        $identityModel->revokeAllHmacTokens($this);
    }

    /**
     * Retrieves all personal HMAC tokens for this user.
     *
     * @return list<AccessToken>
     */
    public function hmacTokens(): array
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        return $identityModel->getAllHmacTokens($this);
    }

    /**
     * Given an HMAC Key, it will locate it within the system.
     */
    public function getHmacToken(?string $key): ?AccessToken
    {
        if (! isset($key) || $key === '') {
            return null;
        }

        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        return $identityModel->getHmacToken($this, $key);
    }

    /**
     * Given the ID, returns the given access token.
     */
    public function getHmacTokenById(int $id): ?AccessToken
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);

        return $identityModel->getHmacTokenById($id, $this);
    }

    /**
     * Determines whether the user's token grants permissions to $scope.
     * First checks against $this->activeToken, which is set during
     * authentication. If it hasn't been set, returns false.
     */
    public function hmacTokenCan(string $scope): bool
    {
        if (! $this->currentHmacToken() instanceof AccessToken) {
            return false;
        }

        return $this->currentHmacToken()->can($scope);
    }

    /**
     * Determines whether the user's token does NOT grant permissions to $scope.
     * First checks against $this->activeToken, which is set during
     * authentication. If it hasn't been set, returns true.
     */
    public function hmacTokenCant(string $scope): bool
    {
        if (! $this->currentHmacToken() instanceof AccessToken) {
            return true;
        }

        return $this->currentHmacToken()->cant($scope);
    }

    /**
     * Returns the current HMAC token for the user.
     */
    public function currentHmacToken(): ?AccessToken
    {
        return $this->currentHmacToken;
    }

    /**
     * Sets the current active token for this user.
     *
     * @return $this
     */
    public function setHmacToken(?AccessToken $accessToken): self
    {
        $this->currentHmacToken = $accessToken;

        return $this;
    }

    /**
     * Checks if the provided HMAC Token is expired.
     */
    public function isHmacTokenExpired(AccessToken $hmacToken): bool
    {
        return $hmacToken->expires instanceof Time && $hmacToken->expires->isBefore(Time::now());
    }

    /**
     * Sets an expiration for HMAC token by ID.
     *
     * @param int  $id        HMAC Token ID
     * @param Time $expiresAt Expiration date
     *
     * @return bool Returns true if expiration date is set or updated.
     */
    public function updateHmacTokenExpiration(int $id, Time $expiresAt): bool
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);
        $result        = $identityModel->setIdentityExpirationById($id, $this, $expiresAt);

        if ($result) {
            // refresh currentHmacToken with updated data
            $this->currentHmacToken = $identityModel->getHmacTokenById($id, $this);
        }

        return $result;
    }

    /**
     * Removes the expiration date for HMAC token by ID.
     *
     * @param int $id HMAC Token ID
     *
     * @return bool Returns true if expiration date is removed
     */
    public function removeHmacTokenExpiration(int $id): bool
    {
        /** @var UserIdentityModel $identityModel */
        $identityModel = model(UserIdentityModel::class);
        $result        = $identityModel->setIdentityExpirationById($id, $this);

        if ($result) {
            // refresh currentHmacToken with updated data
            $this->currentHmacToken = $identityModel->getHmacTokenById($id, $this);
        }

        return $result;
    }

    /**
     * Checks if the current HMAC token has a set expiration date
     */
    public function canHmacTokenExpire(AccessToken $hmacToken): bool
    {
        return $hmacToken->expires !== null;
    }
}
