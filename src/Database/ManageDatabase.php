<?php

namespace Musti\ForgeApi\Database;

use Musti\ForgeApi\Exceptions\PasswordRequired;

trait ManageDatabase
{

    /**
     * List Database for a server
     * 
     * @return Object
     */
    public function listDatabases()
    {
        $request = $this->client->get($this->pathName . "/" . $this->serverId . '/databases');

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * List Database for a server
     * 
     * @return Object
     */
    public function createDatabase(string $name, string $user = null, string $password = null)
    {
        $postData = [
            'name' => $name,
        ];

        if ($user !== null) {

            if ($password === null) {
                throw new PasswordRequired("To create a database you need to provide a password.");
            }

            $postData += [
                'user' => $user,
                'password' => $password,
            ];
        }

        $request = $this->client->post($this->pathName . "/" . $this->serverId . '/databases', [
            'form_params' => $postData,
        ]);

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * @param int $id Database id
     * 
     * @return Object
     */
    public function showDatabase(int $id)
    {
        $request = $this->client->get($this->pathName . "/" . $this->serverId . '/databases/' . $id);

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * @param int $id Database id
     * 
     * @return Object
     */
    public function deleteDatabase(int $id)
    {
        $request = $this->client->delete($this->pathName . "/" . $this->serverId . '/databases/' . $id);

        if ($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Database deleted',
            ]);
        }

        return $this;
    }
}
