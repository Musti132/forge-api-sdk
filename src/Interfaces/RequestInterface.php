<?php
namespace Musti\ForgeApi\Interfaces;

/**
 * @property string $pathName
 * @property string $childPath;
 */
interface RequestInterface {
    public function __construct();

    public function list();

    public function delete();

    public function show(int $id);

    public function update(array $data);

    public function create(array $data);

    public function __toString();
}