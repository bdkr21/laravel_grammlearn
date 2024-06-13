@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->title }}</h5>
                        <p class="card-text">{{ $category->description }}</p>

                        @if (Auth::user()->categories->contains($category->id))
                            <a href="{{ route('category.show', ['category' => $category->slug]) }}" class="btn btn-primary">Learn</a>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>Locked</button>
                            @if (Auth::user()->points >= $category->required_points)
                                <form action="{{ route('category.unlock', ['categoryId' => $category->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-2">Unlock ({{ $category->required_points }} points)</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
