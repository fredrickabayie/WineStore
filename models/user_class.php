<?php

/**
 * Including others files into this document
 */
include_once ( 'adb.php' );

/**
 * Creating an instance of other class in the include files
 */
class User extends adb
{
    
    /**
     * Constructor
     */
    function _construct ( )
    {
        $this->establish_connection ( );
    }//end of constructor
    
    /**
     * Destructor
     */
    function _destruct ( )
    {
        $this->close_connection ( );
    }//end of destructor
    
    
    /**
     * Function to allow user login
     * @param type $username
     * @param type $password
     * @return boolean
     */
    function user_login ( $username, $password )
    {
        $login_query = "select *
                                from system_login
                                join system_users
                                on system_users.user_id=system_login.user_id
                                and system_login.username='$username' 
                                and system_login.password=MD5('$password') 
                                limit 1";
       if ( !$this->query ( $login_query ) )
       {
           return false;
       }
       else
       {
          return $this->fetch ( );
       }
    }//end of add_new_task
        
    
    /**
     * Function to display created tasks
     * @return type Returning the result of the query
     */
    function user_display_created_tasks ( $user_id )
    {
       $display_query = "select task_id, task_description, task_title, user_fname, user_sname,
                                task_start_date, task_end_date
                                from system_tasks
                                join system_users
                                on system_tasks.user_id=system_users.user_id 
                                and system_tasks.user_id='$user_id'
                                order by task_id desc"; 
       return $this->query ( $display_query );
    }//admin_display_all_tasks ( )
    
    
   /**
     * Function to display ssigned tasks
     * @return type Returning the result of the query
     */
    function user_display_assigned_tasks ( $user_id )
    {
       $display_query = "select task_id, task_description, task_title, user_fname, user_sname,
                                task_start_date, task_end_date
                                from system_tasks
                                join system_users
                                on system_tasks.user_id=system_users.user_id 
                                and system_tasks.task_collaborator='$user_id'
                                order by task_id desc";
       try
       {
           return $this->query ( $display_query );
       } catch (Exception $ex) {
           
       }
    }//end of_user_display_tasks ( )
    
    
    /**
     * Function to preview a selected id
     * @param type $task_id The id of task to be previewed
     * @return type Returning the result of the query
     */
    function user_preview_task ( $task_id )
    {
        $preview_query = "select task_id, task_description, task_title, user_fname, user_sname, task_status,
                                    system_tasks.user_id, path, task_collaborator, task_start_date, task_end_date
                                    from system_tasks
                                    join system_users
                                    on system_users.user_id=system_tasks.user_id and system_tasks.task_id='$task_id'";
        return $this->query ( $preview_query );
    }//end of admin_preview_task ( $task_id )
    
    
    /**
     * Function to delete a task
     * @param type $task_id The id of the task to delete
     * @return type Returning the result of the query
     */
    function user_delete_task ( $task_id )
    {
        $delete_query = "delete from system_tasks where task_id='$task_id'";
        return $this->query ( $delete_query );
    }//end of admin_delete_task ( $task_id )
    
    
    /**
     * Function to add a new task
     * @param type $admin_id The user id of the admin
     * @return type Returning the result of the query
     */
    function user_add_new_task ( $task_title, $task_description, $user_id, $task_collaborator,
                                                    $task_start_date, $task_end_date )
    {
        $add_query = "insert into `system_tasks` ( `task_title`, `task_description`, `user_id`,"
                . " `task_collaborator`, `task_start_date`, `task_end_date` )"
                . "values ( '$task_title', '$task_description', '$user_id', '$task_collaborator', "
                . "'$task_start_date', '$task_end_date' )";
        return $this->query ( $add_query );        
    }//end of admin_add_new_task ( $user_id )
        
    
        
}//end of class