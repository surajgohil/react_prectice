<?php
class Main {
    protected $status;
    protected $message;
    protected $data;

    public function __construct() {
        $this->status = '';
        $this->message = '';
        $this->data = [];
    }

    public function apiResponse() {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
?>
