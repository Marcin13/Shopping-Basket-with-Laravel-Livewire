<?php

namespace App\Repositories\Session;

use App\Repositories\Contracts\BasketRepositoryContract;
use Illuminate\Contracts\Session\Session;

class BasketRepository implements BasketRepositoryContract
{
    private ?Session $session;

    //  private ?array $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function add(int $id, int $qty): void
    {
        $this->session->put($this->identity($id), $qty);
    }

    private function identity(int $id): string
    {
        return 'basket.' . $id; // ['basket' => [1 => 3]]
    }

    public function getCurrentQty(int $id): int
    {
        return $this->session->get($this->identity($id), 0);
        // return 1;
    }

    public function all(): array
    {
        return $this->session->get('basket', []);
    }

    public function remove(int $id): void
    {
        $this->session->remove($this->identity($id));
    }
}

