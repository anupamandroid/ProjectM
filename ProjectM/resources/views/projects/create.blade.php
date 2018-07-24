@extends('layouts.app')

@section('content')
<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
    
    <div class="col-md-9 pull-left" style="background: white;">
      <!-- Jumbotron -->
        <h1>Create New Project</h1>

      <!-- Example row of columns -->
      <div class="row col-md-12" style="background-color: white; margin: 10px;">
          <form method="post" action="{{ route('projects.store') }}">
            {{ csrf_field() }}
            
            <input type="hidden" name="_method" value="put">
              
            <div class="form-group">
                <label for="project-name">Name<span class="required">*</span></label>
                <input id="project-name" name="name" spellcheck="false" class="form-control" placeholder="Enter Name" value="" required>
            </div>
              
            @if($companies == null)
                <input type="hidden" class="form-control" name="company_id" value="{{ $company_id }}">
            @endif
              
            @if($companies != null)
            <div class="form-group">
                <label for="project-content">Select Company</label>
                <select name="company_id" class="form-control">
                @foreach($companies as $company)
                    <option vlaue="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                </select>
            </div>
            @endif
              
            <div class="form-group">
                <label for="project-content">Description</label>
                <textarea id="project-content" name="description" spellcheck="false" class="form-control autosize-target text-left" style="resize: vertical" rows="5" placeholder="Enter Description"></textarea>
            </div>
              
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </form>
      </div>
    </div>
    
    <div class="col-md-3 col-sm-3 blog-sidebar pull-right">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>-->
        
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects">All Projects</a></li>
              <li><a href="#">Add new member</a></li>
            </ol>
          </div>
        
          <div class="sidebar-module">
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
          </div>
        </div>
</div>
@endsection