<?php


namespace BuildGrid\Mailers;


use BuildGrid\Project;
use BuildGrid\User;

class ProjectMailer extends Mailer
{

    public function sendProjectCreatedMail(Project $project)
    {
        $project_name = $project->name;

        $subject = 'New project was created';
        $view = 'email.project.new_project';

        $admins = User::where('is_admin', '1');

        foreach ($admins as $admin) {
            $email = $admin->email;
            $admin_name = $admin->getFullNameAttribute();

            $data = [
                'project_name' => $project_name,
                'admin_name' => $admin_name
            ];

            return parent::sendMail($email, $subject, $view, $data);
        }
    }

}