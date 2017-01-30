<select class="js-example-basic-single select2">
  
    @foreach($my_graders as $my_grader)

        @if($my_grader->user->hasRole('grader_a') && $my_grader->hasSite())

            @if($my_grader->id != $site->grader_id && $my_grader->district_id != $site->district_id $my_grader->sites->first()->cat_id)

                <option value="{{ $my_grader->id }}">
                    {{ $my_grader->last_name }} {{ $my_grader->first_name }}
                </option>

            @endif

        @endif

    @endforeach

</select>