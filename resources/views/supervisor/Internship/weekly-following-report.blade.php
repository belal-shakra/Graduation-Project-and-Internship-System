@if (count($student->weekly_followings))
  <section class="container py-5 mx-auto">
      <h2 class="fw-light">Weekly Following Report</h2>

      <div class="container pt-2">
          
          @foreach ($student->weekly_followings as $report)
              <div>
                  <h3 class="fw-light">Week #{{ $report->week }}</h3>
                  <div class="py-2 table-responsive">
                      <div class="table-responsive">
                          <table class="table table-bordered border-dark w-100">
                              <thead class="table-primary">
                                  <th style="width: 13rem;">Task</th>
                                  <th>Software and Hardware</th>
                                  <th style="width: 2rem;">Hours</th>
                              </thead>
                              <tbody class="table-group-divider">
                                  <tr>
                                      <td>{{ $report->task }}</td>
                                      <td>{{ $report->description }}</td>
                                      <td>{{ $report->hour }}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>

  </section>
@endif