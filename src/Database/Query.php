<?php

namespace ALF\Database;

class Query
{
    public function get(array $queryData) {
        // @TODO: maak een query en voer 'm uit
    }

    public function save(ModelItem $model, $data) {
        // update or insert
    }

    public function insert(ModelItem $model, array $data) {

        return $model;
    }

    public function update(ModelItem $model, array $data, int $id) {
        return $model;
    }

    public function delete(int $id) {

    }

    private function _query(string $query, array $params = []) {
        /*try {
            $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }*/


      /*  if ($conn->query($sql) === TRUE) {
            echo "Table MyGuests created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }*/

     /*   $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $firstname, $lastname, $email);
        $stmt->execute();*/
        /*
         *
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }

        //LIMIT 15, 10";

         */
        //   $last_id = $conn->insert_id;


        //$conn = null;
    }
}