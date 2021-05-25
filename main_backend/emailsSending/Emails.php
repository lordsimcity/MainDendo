<?php

namespace EmailsSending;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Emails {

    private $_userEmail;
    private $_emailObject;
    private $_emailContent;

    public function __construct($userEmail,$emailObject,$emailContent) {

        $this->_userEmail = $userEmail;
        $this->_emailObject = $emailObject;
        $this->emailContentBuilding($emailContent);

    }

    protected function emailContentBuilding($body) {

        $emailContent =
        '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;

                    font-family: \'Verdana\';
                }

                .message-body {
                    width: 80%;

                    padding: 6em;

                    background-color: #FFFFFF;
                }

                p {
                    text-align: justify;
                }

                .code-container {
                    border: none;
                    border-radius: 1%;

                    background-color: #34495e;
                    color: #FFFFFF;

                    padding: 1em;

                    margin-bottom: 10vh;
                }

                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                td, th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }

                tr:nth-child(even) {
                    background-color: #dddddd;
                }
            </style>
        </head>
        <body>
            <div class="message-body">
                ' . $body . '
            </div>
        </body>
        </html>';

        $this->_emailContent = $emailContent;

    }

    public function sendAnEmail() {

        if ($_SERVER['SERVER_NAME'] == "localhost" ) {

            $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 587))
                ->setUsername('3cc907a96114c2')
                ->setPassword('340f40edc6f238');

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message($this->_emailObject))
                ->setFrom(['contact@dendo.fr' => 'Customers Team'])
                ->setTo($this->_userEmail)
                ->setBody($this->_emailContent, 'text/html');

            $mailer->send($message);

        } else {

            mail($this->_userEmail, $this->_emailObject, $this->_emailContent);

        }

    }

}
