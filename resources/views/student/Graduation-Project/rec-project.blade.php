@extends('base')

@section('tab-title','Recommended Projects')

@section('content')

<main class="container-fluid py-5 px-4 col-lg-12 col-xl-9">
    <section class="container py-5" id="rec-project">
        <div class="container">
            <!-- Form for student ratings -->
            <div class="row  mb-4 rating-form">
                <div class="col-md-8">
                    <div class="mb-5">
                        <h2>Your Ratings</h2>
                        <span class="lead ps-3">Fill out the form based on your interest and abilities in the field</span>
                    </div>

                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3 border border-1 border-dark rounded">
                                <label for="web_dev_rating" class="input-group-text fw-bold" style="min-width: 11rem;">Web Development</label>
                                <input type="text" name="" id="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 border border-1 border-dark rounded">
                                    <label for="network_rating" class="input-group-text fw-bold" style="min-width: 11rem;">Network</label>
                                    <input type="text" name="" id="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3 border border-1 border-dark rounded">
                                    <label for="security_rating" class="input-group-text fw-bold" style="min-width: 11rem;">Security</label>
                                    <input type="text" name="" id="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 border border-1 border-dark rounded">
                                    <label for="data_science_rating" class="input-group-text fw-bold" style="min-width: 11rem;">Data Science</label>
                                    <input type="text" name="" id="">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Update Ratings" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>


            <!-- Top 5 Recommended projects -->
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">Top 5 Recommended Projects</h2>
                    <div class="card-deck">
                        <a href="{% url 'project-details' value.0.id %}" class="text-decoration-none">
                            <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <p class="card-text text-truncate"></p>
                                <p class="card-text"><b>Average Weekly Hours :</b> 00 hours</p>
                                <p class="card-text"><b>Similarity :</b></p>
                                <span class="btn btn-primary">View Details</span>
                            </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <!-- Other projects you might like -->
            <div class="row mt-5">
                <div class="col-md-10 p-2"> <!-- Add p-2 for small padding -->
                    <h2 class="mb-4">Other Projects You Might Like</h2>
                    <div id="otherProjectsCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item {% if forloop.first %}active{% endif %}">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <a href="{% url 'project-details' project.id %}" class="text-decoration-none">
                                            <div class="card h-100 rounded shadow">
                                                <div class="card-body">
                                                    <h5 class="card-title">title</h5>
                                                    <p class="card-text">hour</p>
                                                    <p class="card-text"><small class="text-muted">Weekly Hours: 00 hours</small></p>
                                                    <p class="card-text"><small class="text-muted">Similarity: 00.0</small></p>
                                                    <span class="text-primary text-decoration-underline">View Full Details</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#otherProjectsCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#otherProjectsCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
