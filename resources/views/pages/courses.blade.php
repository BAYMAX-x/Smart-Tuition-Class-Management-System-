@extends('layouts.portal')

@section('page-title', 'Courses - Smart Tuition CMS')

@section('content')
@php
    $courses = [
        [
            'code' => '01',
            'title' => 'ICT',
            'lecturer' => 'Dr. Jagath Perera',
            'overview' => 'Learn the core building blocks of modern interfaces including HTML5, CSS, and vanilla JS before stepping into frameworks.',
            'completed' => 4,
            'lessons' => 10,
            'cover' => 'https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?w=800',
            'updated_at' => '20 min ago',
        ],
        [
            'code' => '02',
            'title' => 'MATHS',
            'lecturer' => 'Ms. Ravindi Nandasena',
            'overview' => 'From entity-relationship diagrams to writing optimized SQL queries and configuring PostgreSQL for production workloads.',
            'completed' => 2,
            'lessons' => 8,
            'cover' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=800',
            'updated_at' => '1 hr ago',
        ],
        [
            'code' => '03',
            'title' => 'SCIENCE',
            'lecturer' => 'Mr. Supun Perera',
            'overview' => 'Weekly design sprints to iterate on native mobile experiences with Figma, usability testing, and motion guidelines.',
            'completed' => 6,
            'lessons' => 12,
            'cover' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
            'updated_at' => 'Yesterday',
        ],
    ];
@endphp

<section class="courses">
    <header class="courses__header">
        <div class="courses__intro">
            <p class="courses__eyebrow">Academic Year - 2024</p>
            <h1>Available Courses</h1>
        </div>
    </header>

    <div class="courses__grid">
        @foreach ($courses as $course)
            <article class="course-card">
                <figure class="course-card__cover">
                    <img src="{{ $course['cover'] }}" alt="{{ $course['title'] }} module cover">
                    <figcaption>
                        <span class="course-card__code">{{ $course['code'] }}</span>
                        <span class="course-card__name">{{ $course['title'] }}</span>
                    </figcaption>
                    <button class="course-card__options" type="button" aria-label="Course quick actions">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </figure>

                <div class="course-card__body">
                    <div class="course-card__progress" role="group" aria-label="Course progress">
                        <div class="course-card__progress-track"
                            role="progressbar"
                            aria-valuemin="0"
                            aria-valuemax="{{ $course['lessons'] }}"
                            aria-valuenow="{{ $course['completed'] }}">
                            <span class="course-card__progress-fill"
                                style="--progress: {{ ($course['completed'] / $course['lessons']) * 100 }}%;"></span>
                        </div>
                        <span class="course-card__progress-count">
                            {{ $course['completed'] }}/{{ $course['lessons'] }}
                        </span>
                    </div>

                    <dl class="course-card__meta">
                        <div>
                            <dt>Lecturer</dt>
                            <dd>{{ $course['lecturer'] }}</dd>
                        </div>
                        <div>
                            <dt>Overview</dt>
                            <dd>{{ $course['overview'] }}</dd>
                        </div>
                    </dl>
                </div>

                <footer class="course-card__footer">
                    <p class="course-card__status">
                        <span class="status-dot" aria-hidden="true"></span>
                        Updated {{ $course['updated_at'] }}
                    </p>
                    <a href="#" class="course-card__action">
                        <span>view</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12C5 12 8.5 6 12 6C15.5 6 19 12 19 12C19 12 15.5 18 12 18C8.5 18 5 12 5 12Z"
                                stroke-width="1.5" fill="none"></path>
                            <circle cx="12" cy="12" r="2" stroke-width="1.5" fill="none"></circle>
                        </svg>
                    </a>
                </footer>
            </article>
        @endforeach
    </div>
</section>
@endsection
