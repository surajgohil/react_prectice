<?php
class Login extends Main {
    public function __construct() {
        parent::__construct();
    }

    public function get_label() {

        $this->status = 0;
        $this->message = "l_data_not_found";
        $this->data = [
            [
                'id' => 1,
                'content' => 'Hello!',
                'timestamp' => '2024-10-27T12:34:56Z',
                'user' => [
                    'id' => 1,
                    'name' => 'Alice',
                ],
            ],
            [
                'id' => 2,
                'content' => 'Hi there!',
                'timestamp' => '2024-10-27T12:35:00Z',
                'user' => [
                    'id' => 2,
                    'name' => 'Bob',
                ],
            ],
        ];
    }

    public function set_label(){

        $data = $_POST;
        $label = !empty($data['label']) ? $data['label'] : '';

        if($label == ''){
            $this->status = 0;
            $this->message = "l_label_is_required";
        }else{

            $this->status = 0;
            $this->message = "l_set_new_message_successfully";
            $this->data = [
                [
                    'id' => 1,
                    'content' => 'Hello!',
                    'timestamp' => '2024-10-27T12:34:56Z',
                    'user' => [
                        'id' => 1,
                        'name' => 'Alice',
                    ],
                ],
                [
                    'id' => 2,
                    'content' => 'Hi there!',
                    'timestamp' => '2024-10-27T12:35:00Z',
                    'user' => [
                        'id' => 2,
                        'name' => 'Bob',
                    ],
                ]
            ];
        }
    }
}
?>
