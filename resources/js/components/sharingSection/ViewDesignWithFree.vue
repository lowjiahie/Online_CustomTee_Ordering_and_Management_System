
<template>
  <div>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link text-muted fs-5" href="#">View Customer Selling Design</a>
      </li>
      <li class="nav-item">
        <a class="nav-link fw-bold text-dark fs-5" href="#">View Customer Sharing Design</a>
      </li>
    </ul>
    <hr />
    <div class="container p-2 mb-3">
      <div class="title-head">
        <p class="h2">All Customer Sharing Design</p>
      </div>
    </div>
    <div class="pt-2 pb-5">
      <div class="container p-2">
        <div class="row mb-md-2">

          <div v-for="index in 3" :key="index" class="col-md-6 col-lg-4">
            <div class="card shadow p-3 mb-2 bg-body border-0 rounded">
              <a href="#" class="position-relative">
                <img src="../../../../public/image/2.jpg" class="card-img-top" alt="image" />
              </a>
              <div class="card-body">
                <h5 class="fw-bold">New York Window View</h5>
                <em class="text-muted">design by Moon</em>
                <div class="d-flex mb-4">
                  <div class="col pt-4">
                    <span class="h4 text-dark fw-bold">Free</span>
                  </div>
                  <div class="col text-center">
                    <button class="btn btn-outline-dark">View Details</button>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <div class="d-inline p-2">
                    <button type="button" class="btn btn-danger">Report Design</button>
                  </div>
                  <div class="d-inline p-2">
                    <button type="button" class="btn btn-dark">Save to Inventory</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row"></div>
        <div class="row py-4 mt-md-5">
          <div class="col">
            <nav>
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <span class="page-link">Previous</span>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <span class="page-link">2</span>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {},
  methods: {},
};
</script>