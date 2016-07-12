<?php


namespace BuildGrid\Mailers;


use BuildGrid\Bom;
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
        $bom = Bom::where('project_id', $project->id)->first();

        $subject = 'New project was created';
        $view = 'email.project.new_project';
        $data = [
            'project_name' => $project_name,
            'bom_name' => $bom->name,
            'project_bom_admin_url' => url('admin/boms/' . $bom->id )
        ];

        return AdminMailer::sendMailToAdmin($data, $subject, $view);
    }

}
