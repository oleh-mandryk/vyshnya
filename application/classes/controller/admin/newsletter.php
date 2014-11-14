<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Результати голосування
 */
class Controller_Admin_Newsletter extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menupolls');
        $this->template->page_title = 'Розсилка';
        $this->template->title = 'Розсилка';
    }

    public function action_index() {
        $email_type = ORM::factory('emailtype')->find_all();
        $Emails = new Model_Emails();
        $emails_quantity = $Emails->emailsQuantity();
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('subject', 'email_from', 'email_quantity', 'type_id', 'text_massage'));
            
            $emails_personal = $Emails->getEmailsPersonal();
            $emails_personal_str = implode(',', $emails_personal);
            $all_emails_email = $Emails->getEmails($data['email_quantity'], $data['type_id'], 'email');
            $all_emails_id = $Emails->getEmails($data['email_quantity'], $data['type_id'], 'id');
            $all_emails_str = implode(',', $all_emails_email);
            
            try {
                $to = 'alezhuk23@rambler.ru';//$emails_personal_str;
                $to_bcc = $all_emails_str;
                $text_massage = $data['text_massage'];
                $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                $headers .= "From: <{$data['email_from']}>\r\n";
                $headers .= "Bcc: $to_bcc"."\r\n";   
                $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", $data['subject']))."?=";
                
                mail($to, $subject, $text_massage, $headers);
                $Emails->updateEmailsState($all_emails_id);
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/newsletter');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/newsletter/newsletter_view')
            ->bind('emails_quantity', $emails_quantity)
            ->bind('email_type', $email_type)
            ->bind('errors', $errors)
            ->bind('data', $data);

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
}