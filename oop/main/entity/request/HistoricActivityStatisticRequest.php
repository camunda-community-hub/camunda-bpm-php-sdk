<?php

namespace org\camunda\php\sdk\entity\request;

class HistoricActivityStatisticRequest extends Request
{
    protected $canceled;
    protected $finished;
    protected $completeScope;
    protected $sortBy;
    protected $sortOrder;

    /**
     * @param mixed $canceled
     * @return $this
     */
    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCanceled()
    {
        return $this->canceled;
    }

    /**
     * @param mixed $finished
     * @return $this
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $completeScope
     * @return $this
     */
    public function setCompleteScope($completeScope)
    {
        $this->completeScope = $completeScope;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompleteScope()
    {
        return $this->completeScope;
    }

    /**
     * @param mixed $sortBy
     * @return $this
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @param mixed $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}