<?php


namespace BuildGrid\Mailers;


use BuildGrid\Project;
use BuildGrid\User;

class ProjectMailer extends Mailer
{

    /**
     * @param Project $project
     * @return bool
     */
    public static function sendProjectCreatedMail(Project $project)
    {
        $project_name = $project->name;

        $subject = 'New project was created';
        $view = 'email.project.new_project';
        $data = [
            'project_name' => $project_name
        ];

        return AdminMailer::sendMailToAdmin($data, $subject, $view);
    }

}