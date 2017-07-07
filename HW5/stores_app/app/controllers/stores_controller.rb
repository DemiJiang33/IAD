class StoresController < ApplicationController
 
 
  ##########################################################
  def identify_user(id)
             sql = ActiveRecord::Base.connection()
             sql.begin_db_transaction
             query = "select username from users where id = " + id.to_s
             sql.execute(query).fetch_row
  end
 
 
  ##########################################################
  def index
     @title = "Welcome to SJU Online Store"
    
     if session[:user_id]
         flash[:notice] = "Welcome #{identify_user(session[:user_id])}"
         else
         redirect_to    :action=>"login"   
     end
  end
 
 
  ##########################################################
  def about
     @title = "About SJU Online Store" 
    
     if session[:user_id]
         flash[:notice] = "Welcome #{identify_user(session[:user_id])}"
     end   
  end
 
 
 
  ##########################################################
  def help
     @title = "Online SJU Store Help" 
 
     if session[:user_id]
         flash[:notice] = "Welcome #{identify_user(session[:user_id])}"
     end   
  end
 
 
 
  ##########################################################
  def register
    @title = "Online SJU Store Register"
   
    if request.post?
      @user = User.new(params[:user])
     
       if @user.save
             session[:user_id] = @user.id
            
             flash[:notice] = "User #{@user.username} created!"
             redirect_to  :action => "index"
      else
             flash[:notice] = @user.errors.full_messages
      end
 
 
    end
  end
 
 
  ##########################################################
  def logout
         session[:user_id] = nil
 
         flash[:notice] = " "
  end
 
 
 
  ##########################################################
  def login
    @title = "Login to SJU Store"
   
    if request.post?
       @user = User.new()
        @user.username = params[:user][:username]
        @user.email =    params[:user][:email]
        @user.password = params[:user][:password]       
       user =  User.find_by_username_and_password(@user.username, @user.password)
     
      if user
        session[:user_id] = user.id
 
        flash[:notice] = "User #{user.username} logged in!"
        redirect_to :action => "index"
       
      else
        # Don't show the password in the view.
 
        @user.password = nil
        flash[:notice] = "Invalid username/password combination" 
      end
     
    end
  end
 
 
 
 
end