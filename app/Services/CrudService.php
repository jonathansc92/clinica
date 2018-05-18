<?php namespace App\Services;

abstract class CrudService 
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    protected $with = array();
    protected $searchField = null;
    protected $orderBy = null;


    public function listAll(array $parameters = null)
    {
        $query = array_get($parameters, 'query');
        $field = array_get($parameters, 'field', $this->searchField);

        if ($query == null || $field == null) {
            $results = $this->repository->with($this->with)->all(['*'], $this->orderBy);
        } else {
            $results = $this->repository->with($this->with)->findByField($field, $query.'%', 'LIKE');
        }

        return $results;
    }

    public function find($id)
    {
        $result = $this->repository->with($this->with)->find($id);
        return $result;
    }

    public function update(array $data, $id)
    {
        $result = $this->repository->update($data, $id);
        return $result;
    }

    public function create(array $data) {
        $result = $this->repository->create($data);
        return $result;
    }

    public function createOrUpdate(array $data, $primaryKey = 'id')
    {
        $rec = null;
        if (array_key_exists($primaryKey, $data))
            $rec = $this->repository->findByField($primaryKey,$data[$primaryKey]);
        
        if ($rec == null)
            $result = $this->save($data);
        else
            $result = $this->update($data, $data[$primaryKey]);

        return $result;
    }

    public function updateOrCreate(array $data)
    {
        return $this->repository->updateOrCreate($data);
    }

    public function save(array $data)
    {
        $result = $this->repository->create($data);
        return $result;
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

    public function paginate()
    {
        return $this->repository->with($this->with)->paginate(10, ['*'], $this->orderBy);
    }
}
