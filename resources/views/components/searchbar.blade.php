 <div class="banner-anform">
 
       <form action="{{ route('jobs.search') }}" method="get" class="booking-form mb-auto">

        <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="form-group">
        <i class="fa fa-briefcase"></i>

        <select id="category" name="category">
        <option value="">Select Category</option>

        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach

        </select>
        </div>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="form-group">
        <i class="fas fa-pencil"></i>

        <select id="designation" name="designation">
        <option value="">Select Designation</option>
        </select>

        </div>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="form-group">
        <i class="fas fa-location-dot"></i>

        <select id="location" name="location">
        <option value="">Select Location</option>
        </select>

        </div>
        </div>


        <div class="col-auto">
        <div class="message-btn">
        <button type="submit" class="th-btn style2 w-100">
        <i class="fa fa-search"></i>Search
        </button>
        </div>
        </div>

        </div>

        </form>

						 
	</div>



    <script>

                document.getElementById('category').addEventListener('change', function() {

            let categoryId = this.value;

            fetch('/api/categories/' + categoryId + '/designations')
            .then(res => res.json())
            .then(data => {

                let designation = document.getElementById('designation');
                designation.innerHTML = '<option value="">Select Designation</option>';

                data.forEach(function(item){
                    designation.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });

                document.getElementById('location').innerHTML =
                '<option value="">Select Location</option>';

            });

        });


        document.getElementById('designation').addEventListener('change', function() {

            let designationId = this.value;

            fetch('/api/designations/' + designationId + '/locations')
            .then(res => res.json())
            .then(data => {

                let location = document.getElementById('location');
                location.innerHTML = '<option value="">Select Location</option>';

                data.forEach(function(item){
                    location.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });

            });

        });

    </script>