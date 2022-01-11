<?php

namespace Musti\ForgeApi\Database;

trait ManageDatabaseUsers
{
    protected $userId;
    protected $subPath = "database-users";

    /**
     * Create a user for a database
     * 
     * @param string $name
     * @param string $password
     * @param array $databases Databases that user will have access to
     * 
     * @return void
     */
    public function createDatabaseUser(string $name, string $password, array $databases)
    {
        $postData = [
            'name' => $name,
            'password' => $password,
            'databases' => $databases,
        ];

        $request = $this->client->post($this->pathName . '/' . $this->serverId . '/' . $this->subPath, [
            'form_params' => $postData,
        ]);

        $this->response = $request->getBody();

        return $this;
    }
    /**
     * List all users 
     * 
     * @return void
     */
    public function databaseUsers()
    {
        $request = $this->client->get($this->pathName . '/' . $this->serverId . '/' . $this->subPath);

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * Return database user information
     * 
     * @return void
     */
    public function showDatabaseUser()
    {
        $request = $this->client->get($this->pathName . '/' . $this->serverId . '/' . $this->subPath . '/' . $this->userId);

        $this->response = $request->getBody();

        return $this;
    }

    /**
     * Update database the database user has access to
     * 
     * @param array $databases Database ids
     * 
     * @return void
     */
    public function updateDatabaseUser(array $databases)
    {
        $request = $this->client->put($this->pathName . '/' . $this->serverId . '/' . $this->subPath . '/' . $this->userId, [
            'form_params' => [
                'databases' => $databases
            ]
        ]);

        if ($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Database deleted',
            ]);
        }

        return $this;
    }

    public function deleteDatabaseUser(int $id)
    {
        $request = $this->client->delete($this->pathName . '/' . $this->serverId . '/' . $this->subPath . '/' . $id);

        if ($request->getStatusCode() == 200) {
            $this->response = json_encode([
                'status' => 'success',
                'message' => 'Database deleted',
            ]);
        }

        return $this;
    }

    public function setDatabaseUserId(int $id)
    {
        $this->userId = $id;

        return $this;
    }
}
