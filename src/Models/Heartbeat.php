<?php

namespace MichaelDrennen\EnvoyerAPI\Models;

use Carbon\Carbon;

class Heartbeat {

    /**
     * @var int
     */
    public $id;


    /**
     * @var int
     */
    public $projectId;


    /**
     * @var string
     */
    public $name;


    /**
     * @var string
     */
    public $token;


    /**
     * @var int
     */
    public $interval;


    /**
     * @var string
     */
    public $status;
    const healthy = 'healthy';
    const missing = 'missing';


    /**
     * @var Carbon
     */
    public $lastCheckedInAt;


    /**
     * @var Carbon
     */
    public $createdAt;


    /**
     * @var Carbon
     */
    public $updatedAt;


    /**
     * @param array $dataFromAPI
     */
    public function __construct( array $dataFromAPI ) {
        $this->id              = $dataFromAPI[ 'id' ] ?? NULL;
        $this->projectId       = $dataFromAPI[ 'project_id' ] ?? NULL;
        $this->name            = $dataFromAPI[ 'name' ] ?? NULL;
        $this->token           = $dataFromAPI[ 'token' ] ?? NULL;
        $this->interval        = $dataFromAPI[ 'interval' ] ?? NULL;
        $this->status          = $dataFromAPI[ 'status' ] ?? NULL;
        $this->lastCheckedInAt = isset( $dataFromAPI[ 'last_checked_in_at' ] ) ? Carbon::parse( $dataFromAPI[ 'last_checked_in_at' ] ) : NULL;
        $this->createdAt       = isset( $dataFromAPI[ 'created_at' ] ) ? Carbon::parse( $dataFromAPI[ 'created_at' ] ) : NULL;
        $this->updatedAt       = isset( $dataFromAPI[ 'updated_at' ] ) ? Carbon::parse( $dataFromAPI[ 'updated_at' ] ) : NULL;
    }


    /**
     * @return bool
     */
    public function isMissing(): bool {
        return self::missing == $this->status;
    }


    /**
     * @return bool
     */
    public function isHealthy(): bool {
        return self::healthy == $this->status;
    }


}