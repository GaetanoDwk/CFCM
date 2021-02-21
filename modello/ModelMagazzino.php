<?php

/**
 * Class ModelMagazzino
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli elementi della tabella "magazzino"
 * Gli elementi della tabella "magazzino" rappresentano il numero di plichi da restituire al cliente.
 */
class ModelMagazzino {

    /**
     * Variabili di classe
     * @var int $id
     * @var string $procura
     * @var string $dossier
     * @var tinyint $plico
     * @var data $data
     * @var string $note
     *
     */
    private $id,
            $procura,
            $pm,
            $dossier,
            $plico,
            $data,
            $note;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProcura()
    {
        return $this->procura;
    }

    /**
     * @param mixed $procura
     */
    public function setProcura($procura)
    {
        $this->procura = $procura;
    }

    /**
     * @return mixed
     */
    public function getPm()
    {
        return $this->pm;
    }

    /**
     * @param mixed $pm
     */
    public function setPm($pm)
    {
        $this->pm = $pm;
    }

    /**
     * @return mixed
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * @param mixed $dossier
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;
    }

    /**
     * @return mixed
     */
    public function getPlico()
    {
        return $this->plico;
    }

    /**
     * @param mixed $plico
     */
    public function setPlico($plico)
    {
        $this->plico = $plico;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }


    /**
     * Seleziona tutti gli elementi nella tabella "magazzino"
     * @return array
     */
    public function select_all()
    {
        $res = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT id, 
                                                procura, 
                                                pm, 
                                                dossier, 
                                                plico, 
                                                DATE_FORMAT(dataC, '%d-%m-%Y') AS dataC, 
                                                note FROM magazzino ORDER BY procura ASC");
        $sql->execute();

        while($row = $sql->fetch())
        {
            $res[] = array(
                'id' => $row['id'],
                'procura' => $row['procura'],
                'pm' => $row['pm'],
                'dossier' => $row['dossier'],
                'plico' => $row['plico'],
                'dataC' => $row['dataC'],
                'note' => $row['note']);
        }

        return $res;

    }


    /**
     * Seleziona un singolo elemento nella tabella "magazzino"
     * @param $id
     */
    public function select_single($id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM magazzino WHERE id = $id");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $this->setId($row['id']);
            $this->setProcura($row['procura']);
            $this->setPm($row['pm']);
            $this->setDossier($row['dossier']);
            $this->setPlico($row['plico']);
            $this->setData($row['dataC']);
            $this->setNote($row['note']);

        }
    }


    /**
     * Inserisce un nuovo elemento nella tabella "magazzino"
     * @param string $procura
     * @param string $pm
     * @param string $dossier
     * @param tinyint $plico
     * @param data $data
     * @param string $note
     */
    public function insert($procura, $pm, $dossier, $plico, $data, $note)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("INSERT INTO magazzino (procura, pm, dossier, plico, dataC, note) VALUES(\"$procura\", \"$pm\", \"$dossier\", '$plico', \"$data\", \"$note\")");
        $sql->execute();

    }


    /**
     * Aggiorna le info nella tabella "magazzino" relative ad un dato elemento
     * @param int $id
     * @param string $procura
     * @param string $pm
     * @param string $dossier
     * @param tinyint $plico
     * @param data $dataC
     * @param string $note
     */
    public function update($id, $procura, $pm, $dossier, $plico, $dataC, $note)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE magazzino SET id = '$id',
                                                              procura = '$procura',
                                                              pm = '$pm',
                                                              dossier = '$dossier',
                                                              plico = $plico, 
                                                              dataC = '$dataC', 
                                                              note = '$note' WHERE id = $id");
        $sql->execute();

    }


    /**
     * Elimina un elemento dalla tabella "magazzino"
     * @param $id
     */
    public function delete($id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("DELETE from magazzino WHERE id =". $id);
        $sql->execute();
    }

}
