@extends('layouts.app')

@section('content')
<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
    
    <div class="col-md-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>

      <!-- Example row of columns -->
      <div class="row container-fluid" style="background-color: white; margin: 10px;">
          <a href="/projects/create/{{ $project->id }}" class="pull-right btn btn-default btn-sm">Add Project</a>
          <br>
          
          <form method="post" action="{{ route('comments.store') }}">
            {{ csrf_field() }}
            
            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{ $project->id }}">
              
            <div class="form-group">
                <label for="comment-content">Comment</label>
                <textarea id="comment-content" name="body" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="3" placeholder="Enter Comment"></textarea>
            </div>
            
            <div class="form-group">
                <label for="comment-content">Proof of work done (Url/Photos)</label>
                <textarea id="comment-content" name="url" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="2" placeholder="Enter Url or screenshots"></textarea>
            </div>
              
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </form>
          
       {{--    @foreach($project->projects as $project)
        <div class="col-lg-4">
          <h2>{{ $project->name }}</h2>
          <p class="text-danger">{{ $project->description }}</p>
          <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View details</a></p>
        </div>
          @endforeach --}}
      </div>
        
      <!--@foreach($project->comments as $comment)
        <div class="col-lg-4">
          <h2>{{ $comment->body }}</h2>
          <p class="text-danger">{{ $comment->url }}</p>
          <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View Project</a></p>
        </div>
      @endforeach-->
        
        @include('partials.comments')
    </div>
    
    <div class="col-md-3 col-sm-3 blog-sidebar pull-right">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>-->
        
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
              <li><a href="/projects/create/{{ $project->id }}">Add Project</a></li>
              <li><a href="/projects">My projects</a></li>
              <li><a href="/projects/create">Add new project</a></li>
              <br>
                
              @if($project->user_id == Auth::user()->id)
              <li><a href="#" 
                     onclick="
                        var result = confirm('Are you sure you wish to delete this project - {{ $project->name }} ?');
                            if(result){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                            }
                  ">Delete</a>
                  
                    <form id="delete-form" action="{{ route('projects.destroy', [ $project->id ])}}" method="post" style="display:none;">
                        <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                    </form>
                
              </li>
              @endif
              <!--<li><a href="#">Add new member</a></li>-->
            </ol>
              
            <hr>
              
            <h4>Add Member</h4>
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <form id="add-user" action="{{ route('projects.addUser') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                      <input type="text" class="form-control" name="email" placeholder="Email">
                      <input type="hidden" class="form-control" name="project_id" value="{{ $project->id }}">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Add</button>
                      </span>
                    </div><!-- /input-group -->
                </form>
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
              
            <br>
              
            <h4>Team Members</h4>
            <ol class="list-unstyled">
              @foreach($project->users as $user)
                <li><a href="#">{{ $user->email }}</a></li>
              @endforeach
            </ol>
          </div>
        
          
          <!--<div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>-->
          <!--<div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>-->
        </div>
</div>
@endsection