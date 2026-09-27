@extends('layouts.admin.base') 

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">
                Dashboard
            </h1>

            {{-- Flash Messages --}}
            @include('includes.flash_message')

            <div class="alert alert-info">
                <i class="fa fa-user-circle"></i>

                <strong>
                    Welcome back, {{ Auth::user()->name }}!
                </strong>
            </div>

        </div>
    </div>

   <!-- Dashboard Summary Panels -->
   <div class="row">
      <!-- Skills -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-code fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $skillCount }}</div>
                     <div>Skills</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/skills') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Skills </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Educations -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-green">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-graduation-cap fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $educationCount }}</div>
                     <div>Educations</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/educations') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Educations </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Experience -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-yellow">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-suitcase fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $experienceCount }}</div>
                     <div>Experience</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/experiences') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Experiences </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Services -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-red">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-briefcase fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $serviceCount }}</div>
                     <div>Services</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/services') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Services </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Projects -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-info">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-folder-open fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $projectCount }}</div>
                     <div>Projects</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/projects') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Projects </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Testimonials -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-warning">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-comments fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $testimonialCount }}</div>
                     <div>Testimonials</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/testimonials') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Testimonials </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Messages -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-success">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-envelope fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $messageCount }}</div>
                     <div>Messages</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/messages') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Messages </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>

      <!-- Users -->
      <div class="col-lg-3 col-md-6">
         <div class="panel panel-danger">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-3">
                     <i class="fa fa-user fa-5x"></i>
                  </div>

                  <div class="col-xs-9 text-right">
                     <div class="huge">{{ $userCount }}</div>
                     <div>Users</div>
                  </div>
               </div>
            </div>

            <a href="{{ url('admin/users') }}">
               <div class="panel-footer">
                  <span class="pull-left"> View Users </span>

                  <span class="pull-right">
                     <i class="fa fa-arrow-circle-right"></i>
                  </span>

                  <div class="clearfix"></div>
               </div>
            </a>
         </div>
      </div>
   </div>

   <!-- Projects & Testimonials -->
   <div class="row">
      <!-- Latest Projects -->
      <div class="col-md-6">
         <div class="panel panel-default">
            <div class="panel-heading">Latest Projects</div>

            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Image</th>
                           <th>Project</th>
                        </tr>
                     </thead>

                     <tbody>
                        @forelse ($projects as $project)

                        <tr>
                           <td>
                              <img src="{{ asset('uploads/images/'.$project->image) }}" width="80" height="60"
                                 style="object-fit:cover; border-radius:4px; box-shadow:0 2px 5px rgba(0,0,0,.15);"
                                 alt="{{ $project->title }}"
                              />
                           </td>

                           <td>{{ $project->title }}</td>
                        </tr>

                        @empty

                        <tr>
                           <td colspan="2" class="text-center">
                              No projects found.
                           </td>
                        </tr>

                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <!-- Latest Testimonials -->
      <div class="col-md-6">
         <div class="panel panel-default">
            <div class="panel-heading">Latest Testimonials</div>

            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Image</th>
                           <th>Testimonial</th>
                        </tr>
                     </thead>

                     <tbody>
                        @forelse ($testimonials as $testimonial)

                        <tr>
                           <td>
                              <img
                                src="{{ asset('uploads/images/'.$testimonial->image) }}"
                                width="60"
                                height="60"
                                class="img-circle"
                                style="object-fit:cover; border:2px solid #eee; box-shadow:0 2px 5px rgba(0,0,0,.15);"
                                alt="{{ $testimonial->name }}"
                                />
                           </td>

                           <td>
                              <strong> {{ $testimonial->name }} </strong>

                              <br />

                              {{ Str::limit($testimonial->testimony, 50) }}
                           </td>
                        </tr>

                        @empty

                        <tr>
                           <td colspan="2" class="text-center">
                              No testimonials found.
                           </td>
                        </tr>

                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

<!-- Skills & Chart -->
<div class="row">
   <!-- Skills Overview -->
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading"><i class="fa fa-bar-chart"></i> Skills & Service Overview</div>
         <div class="panel-body">
            @foreach ($services as $service)
               <h4><strong>{{ $service->name }}</strong></h4>
               @foreach ($service->skills as $skill)
                  <p>{{ $skill->name }} <span class="pull-right"><strong>{{ $skill->proficiency }}%</strong></span></p>
                  <div class="progress" style="height:20px;">
                     <div class="progress-bar skill-progress" role="progressbar" data-value="{{ $skill->proficiency }}" style="width:0%;" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
               @endforeach
               <hr>
            @endforeach
         </div>
      </div>
   </div>

   <!-- Analytics Chart -->
   <div class="col-md-6">
      <div class="panel panel-default">
         <div class="panel-heading"><i class="fa fa-line-chart"></i> Skills Analytics</div>
         <div class="panel-body"><canvas id="myChart" height="300"></canvas></div>
      </div>
   </div>
</div>




@endsection


@push('styles')

<style>
   .skill-progress { border-radius:10px; position:relative; overflow:hidden; }
   .skill-progress::after {
      content:"";
      position:absolute;
      top:0;
      left:-100%;
      width:50%;
      height:100%;
      background:linear-gradient(90deg,transparent,rgba(255,255,255,.35),transparent);
      animation:progressShine 2s infinite;
   }
   @keyframes progressShine {
      0% { left:-100%; }
      100% { left:200%; }
   }
</style>

@endpush


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      function randomColor() {
         return `hsl(${Math.floor(Math.random() * 360)},75%,55%)`;
      }

      document.querySelectorAll('.skill-progress').forEach(function(bar, i) {
         bar.style.backgroundColor = randomColor();
         setTimeout(function() {
            bar.style.transition = 'width 1.5s ease-in-out';
            bar.style.width = bar.dataset.value + '%';
         }, i * 150);
      });

      const canvas = document.getElementById('myChart');
      if (!canvas) return;

      const labels = [
         @foreach ($skills as $skill)
            @json($skill->name),
         @endforeach
      ];

      const values = [
         @foreach ($skills as $skill)
            {{ $skill->proficiency }},
         @endforeach
      ];

      const colors = labels.map(() => randomColor());

      new Chart(canvas, {
         type: 'bar',
         data: {
            labels: labels,
            datasets: [{
               label: 'Skill Proficiency (%)',
               data: values,
               backgroundColor: colors,
               borderColor: colors,
               borderWidth: 1,
               borderRadius: 5
            }]
         },
         options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 1500, easing: 'easeOutQuart' },
            plugins: {
               legend: { display: false },
               title: { display: true, text: 'Skills Proficiency Analytics' },
               tooltip: {
                  callbacks: {
                     label: context => context.parsed.y + '% proficiency'
                  }
               }
            },
            scales: {
               y: {
                  beginAtZero: true,
                  max: 100,
                  ticks: { callback: value => value + '%' }
               }
            }
         }
      });
   });
</script>

@endpush
