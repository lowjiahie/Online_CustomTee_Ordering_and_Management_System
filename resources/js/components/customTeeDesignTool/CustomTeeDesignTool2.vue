<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-1 shadow p-2 bg-body rounded bg-white pt-3">
        <div class="row mb-5 gy-3">
          <div class="col-12 text-center">
            <svg
              t="1661709176932"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="2698"
              width="25"
              height="25"
            >
              <path
                d="M576 320H237.248l137.344-137.344a32 32 0 0 0-45.248-45.248L137.408 329.344a31.744 31.744 0 0 0 0 45.312l191.936 191.936a32 32 0 1 0 45.312-45.184L237.248 384H576c105.856 0 192 86.144 192 192s-86.144 192-192 192H416a32 32 0 0 0 0 64H576c141.184 0 256-114.816 256-256s-114.816-256-256-256z"
                p-id="2699"
              />
            </svg>
            <br />undo
          </div>
          <div class="col-12 text-center">
            <svg
              t="1661709108429"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="2544"
              width="25"
              height="25"
            >
              <path
                d="M829.568 364.224a31.744 31.744 0 0 0-6.976-34.88l-191.936-192a32 32 0 0 0-45.248 45.248L722.752 320H384C242.816 320 128 434.816 128 576s114.816 256 256 256h160a32 32 0 0 0 0-64H384c-105.856 0-192-86.144-192-192s86.144-192 192-192h338.752L585.344 521.344a32 32 0 0 0 45.312 45.312l191.936-191.936a34.176 34.176 0 0 0 6.976-10.496z"
                p-id="2545"
              />
            </svg>
            <br />redo
          </div>
        </div>
        <div class="mt-5 row gy-4">
          <div class="col-12 text-center">
            <button class="btn btn-sm btn-dark">View Front</button>
          </div>
          <div class="col-12 text-center">
            <button class="btn btn-sm btn-outline-secondary">View Back</button>
          </div>
          <div class="col-12 text-center">
            <svg
              t="1661710331664"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="8823"
              width="25"
              height="25"
            >
              <path
                d="M416.995556 628.337778a30.151111 30.151111 0 0 0 30.435555 30.435555 30.435556 30.435556 0 0 0 30.72-30.435555v-74.808889a215.04 215.04 0 0 1 213.902222-213.902222h67.982223l-67.982223 67.982222a28.444444 28.444444 0 0 0 0 44.088889 28.444444 28.444444 0 0 0 20.195556 10.24 24.462222 24.462222 0 0 0 20.48-10.24l95.004444-95.004445a65.706667 65.706667 0 0 0 0-95.288889l-85.333333-85.333333a28.444444 28.444444 0 0 0-44.088889 0 28.444444 28.444444 0 0 0 0 44.088889L763.448889 284.444444h-74.808889a276.195556 276.195556 0 0 0-275.057778 275.057778z"
                p-id="8824"
              />
              <path
                d="M848.213333 560.355556a30.435556 30.435556 0 0 0-30.435555 30.72v173.226666a42.382222 42.382222 0 0 1-44.373334 40.675556H250.595556a42.382222 42.382222 0 0 1-44.373334-40.675556V271.644444a42.382222 42.382222 0 0 1 44.373334-40.675555h213.902222a30.72 30.72 0 0 0 0-61.155556H250.595556A105.244444 105.244444 0 0 0 145.066667 271.644444v492.657778a102.968889 102.968889 0 0 0 105.528889 101.831111h522.808888a105.244444 105.244444 0 0 0 105.528889-101.831111v-173.226666a30.72 30.72 0 0 0-30.72-30.72z"
                p-id="8825"
              />
            </svg>
            Share/Sell
          </div>
        </div>
      </div>
      <div class="col-6">
        <!-- Create the container of the tool -->
        <div id="tshirt-div">
          <!-- 
        Initially, the image will have the background tshirt that has transparency
        So we can simply update the color with CSS or JavaScript dinamically
          -->
          <img id="tshirt-backgroundpicture" src="../../../../public/image/crew_front.png" />

          <!-- 
        The container where Fabric.js will work. Notice that in the the style of #canvas
        the width and height need to match with the attributes
          -->
          <div id="drawingArea" class="drawing-area">
            <div class="canvas-container mt-5">
              <canvas id="canvas" width="225" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5 bg-white pt-2 pe-2">
        <div class="d-flex flex-row border b-1 mb-3 shadow p-2 bg-body rounded">
          <div class="p-2 flex-fill text-center">
            <svg
              t="1661710690476"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="9790"
              width="25"
              height="25"
            >
              <path
                d="M512 704.1c-4.7 0-9.4-1-13.8-3.1l-352-168.1c-11.2-5.4-18.3-16.7-18.2-29.2 0.1-12.4 7.4-23.7 18.8-28.8l88-40c16.1-7.3 35.1-0.2 42.4 15.9 7.3 16.1 0.2 35.1-15.9 42.4l-25.5 11.6L512 636.6l276.2-131.9-21.1-9.6c-16.1-7.3-23.2-26.3-15.9-42.4 7.3-16.1 26.3-23.2 42.4-15.9l83.7 38c11.3 5.1 18.6 16.4 18.8 28.8 0.1 12.4-7 23.8-18.2 29.2l-352 168.1c-4.5 2.1-9.2 3.2-13.9 3.2z"
                p-id="9791"
              />
              <path
                d="M512 896.1c-4.7 0-9.4-1-13.8-3.1l-352-168.1c-11.2-5.4-18.3-16.7-18.2-29.2 0.1-12.4 7.4-23.7 18.8-28.8l88-40c16.1-7.3 35.1-0.2 42.4 15.9 7.3 16.1 0.2 35.1-15.9 42.4l-25.5 11.6L512 828.6l276.2-131.9-21.1-9.6c-16.1-7.3-23.2-26.3-15.9-42.4 7.3-16.1 26.3-23.2 42.4-15.9l83.7 38c11.3 5.1 18.6 16.4 18.8 28.8 0.1 12.4-7 23.8-18.2 29.2l-352 168.1c-4.5 2.1-9.2 3.2-13.9 3.2zM512.1 515c-4.5 0-9.1-1-13.3-2.9l-8.6-3.9c-0.1-0.1-0.2-0.1-0.3-0.2L146.4 346.5c-11.3-5.3-18.5-16.8-18.4-29.3 0.1-12.5 7.5-23.8 18.9-28.9l352-157.5c8.3-3.7 17.8-3.7 26.1 0l352 157.5c11.4 5.1 18.8 16.4 18.9 28.9 0.1 12.5-7.1 23.9-18.4 29.3L534.2 508c-0.1 0-0.1 0.1-0.2 0.1l-8.5 3.9c-4.3 2-8.8 3-13.4 3z m8.5-35.9zM236.7 318.3L512 447.7l275.3-129.5L512 195.1 236.7 318.3z"
                p-id="9792"
              />
            </svg>
            <br />Group
          </div>
          <div class="p-2 text-center flex-fill bd-highlight">
            <svg
              t="1662285180560"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="2419"
              width="25"
              height="25"
            >
              <path
                d="M128 554.666667h85.333333v-85.333334H128v85.333334z m0 170.666666h85.333333v-85.333333H128v85.333333z m85.333333 170.666667v-85.333333H128c0 47.146667 38.186667 85.333333 85.333333 85.333333zM128 384h85.333333v-85.333333H128v85.333333z m512 512h85.333333v-85.333333h-85.333333v85.333333z m170.666667-768H384c-47.146667 0-85.333333 38.186667-85.333333 85.333333v426.666667c0 47.146667 38.186667 85.333333 85.333333 85.333333h426.666667c47.146667 0 85.333333-38.186667 85.333333-85.333333V213.333333c0-47.146667-38.186667-85.333333-85.333333-85.333333z m0 512H384V213.333333h426.666667v426.666667zM469.333333 896h85.333334v-85.333333h-85.333334v85.333333z m-170.666666 0h85.333333v-85.333333h-85.333333v85.333333z"
                p-id="2420"
              />
            </svg>
            <br />Sending Front
          </div>
          <div class="p-2 text-center flex-fill bd-highlight">
            <svg
              t="1662285287834"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="7580"
              width="25"
              height="25"
            >
              <path
                d="M384 298.666667h-85.333333v85.333333h85.333333v-85.333333z m0 170.666666h-85.333333v85.333334h85.333333v-85.333334z m0-341.333333c-47.146667 0-85.333333 38.186667-85.333333 85.333333h85.333333V128z m170.666667 512h-85.333334v85.333333h85.333334v-85.333333zM810.666667 128v85.333333h85.333333c0-47.146667-38.186667-85.333333-85.333333-85.333333zM554.666667 128h-85.333334v85.333333h85.333334V128z m-170.666667 597.333333v-85.333333h-85.333333c0 47.146667 38.186667 85.333333 85.333333 85.333333z m426.666667-170.666666h85.333333v-85.333334h-85.333333v85.333334z m0-170.666667h85.333333v-85.333333h-85.333333v85.333333z m0 341.333333c47.146667 0 85.333333-38.186667 85.333333-85.333333h-85.333333v85.333333zM213.333333 298.666667H128v512c0 47.146667 38.186667 85.333333 85.333333 85.333333h512v-85.333333H213.333333V298.666667z m426.666667-85.333334h85.333333V128h-85.333333v85.333333z m0 512h85.333333v-85.333333h-85.333333v85.333333z"
                p-id="7581"
              />
            </svg>
            <br />Sending Back
          </div>
          <div class="p-2 flex-fill text-center">
            <svg
              t="1661711540916"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="11828"
              width="25"
              height="25"
            >
              <path
                d="M111.395066 570.932204l87.488587 0 0 255.842922-87.488587 0 0-255.842922Z"
                p-id="11829"
              />
              <path
                d="M825.115324 570.932204l87.488587 0 0 255.842922-87.488587 0 0-255.842922Z"
                p-id="11830"
              />
              <path
                d="M111.395066 826.775126l801.208844 0 0 87.866187-801.208844 0 0-87.866187Z"
                p-id="11831"
              />
              <path
                d="M563.245128 722.759121 463.476867 722.759121 463.476867 287.760866 320.414567 429.16234 256.453836 365.201609 512.296759 109.358687 768.138658 365.201609 704.178951 429.16234 561.710169 290.830785Z"
                p-id="11832"
              />
            </svg>
            <br />Upload Image
          </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="home-tab"
              data-bs-toggle="tab"
              data-bs-target="#home"
              type="button"
              role="tab"
              aria-controls="home"
              aria-selected="true"
            >
              <svg
                t="1661711426871"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="10721"
                width="25"
                height="25"
              >
                <path
                  d="M853.333333 138.666667H170.666667c-17.066667 0-32 14.933333-32 32v128c0 17.066667 14.933333 32 32 32s32-14.933333 32-32V202.666667h277.333333v618.666666H384c-17.066667 0-32 14.933333-32 32s14.933333 32 32 32h256c17.066667 0 32-14.933333 32-32s-14.933333-32-32-32h-96v-618.666666h277.333333V298.666667c0 17.066667 14.933333 32 32 32s32-14.933333 32-32V170.666667c0-17.066667-14.933333-32-32-32z"
                  p-id="10722"
                />
              </svg>
              <br />Add Text
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="profile-tab"
              data-bs-toggle="tab"
              data-bs-target="#profile"
              type="button"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
            >
              <svg
                t="1661732897637"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="17707"
                width="25"
                height="25"
              >
                <path
                  d="M691.26144 972.8h-409.6c-42.3424 0-76.8-34.4576-76.8-76.8V419.5328l-119.9104 39.9872a25.6 25.6 0 0 1-32.3584-16.1792l-51.2-153.6a25.5488 25.5488 0 0 1 12.8512-30.976l307.2-153.6A25.6 25.6 0 0 1 358.46144 128.0512c0 70.5536 57.4464 128 128 128s128-57.4464 128-128a25.6 25.6 0 0 1 37.0176-22.8864l307.2 153.6a25.6 25.6 0 0 1 12.8512 30.976l-51.2 153.6a25.5488 25.5488 0 0 1-32.3584 16.1792L768.06144 419.5328V896c0 42.3424-34.4576 76.8-76.8 76.8z m-460.8-614.4a25.4976 25.4976 0 0 1 25.6 25.6v512a25.6 25.6 0 0 0 25.6 25.6h409.6a25.6 25.6 0 0 0 25.6-25.6v-512a25.5488 25.5488 0 0 1 33.6896-24.32l129.3312 43.1104 36.096-108.2368-254.6176-127.3344c-17.9712 79.9744-89.5488 139.9296-174.848 139.9296S329.58464 247.1936 311.66464 167.2192L57.04704 294.5536l36.096 108.2368 129.3312-43.1104a26.0096 26.0096 0 0 1 8.0896-1.3312z"
                  fill
                  p-id="17708"
                />
              </svg>
              <br />Add Design
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="contact-tab"
              data-bs-toggle="tab"
              data-bs-target="#contact"
              type="button"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
            >
              <svg
                t="1661711774448"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="12917"
                width="25"
                height="25"
              >
                <path
                  d="M373.333333 149.333333A224 224 0 0 0 341.333333 595.072v64.512A288.042667 288.042667 0 1 1 659.584 341.333333h-64.512A224.042667 224.042667 0 0 0 373.333333 149.333333z"
                  p-id="12918"
                />
                <path
                  d="M522.666667 384A138.666667 138.666667 0 0 0 384 522.666667v277.333333A138.666667 138.666667 0 0 0 522.666667 938.666667h277.333333A138.666667 138.666667 0 0 0 938.666667 800v-277.333333A138.666667 138.666667 0 0 0 800 384h-277.333333z m-74.666667 138.666667c0-41.216 33.450667-74.666667 74.666667-74.666667h277.333333c41.216 0 74.666667 33.450667 74.666667 74.666667v277.333333a74.666667 74.666667 0 0 1-74.666667 74.666667h-277.333333a74.666667 74.666667 0 0 1-74.666667-74.666667v-277.333333z"
                  p-id="12919"
                />
              </svg>
              <br />Add Shape
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="contact-tab"
              data-bs-toggle="tab"
              data-bs-target="#contact"
              type="button"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
            >
              <svg
                t="1661711965379"
                class="icon"
                viewBox="0 0 1024 1024"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                p-id="13841"
                width="25"
                height="25"
              >
                <path
                  d="M906.666667 298.666667L725.333333 117.333333c-14.933333-14.933333-32-21.333333-53.333333-21.333333H170.666667C130.133333 96 96 130.133333 96 170.666667v682.666666c0 40.533333 34.133333 74.666667 74.666667 74.666667h682.666666c40.533333 0 74.666667-34.133333 74.666667-74.666667V349.866667c0-19.2-8.533333-38.4-21.333333-51.2zM652.8 864H371.2V648.533333h281.6v215.466667z m211.2-10.666667c0 6.4-4.266667 10.666667-10.666667 10.666667h-140.8V618.666667c0-17.066667-12.8-29.866667-29.866666-29.866667H341.333333c-17.066667 0-29.866667 12.8-29.866666 29.866667v245.333333H170.666667c-6.4 0-10.666667-4.266667-10.666667-10.666667V170.666667c0-6.4 4.266667-10.666667 10.666667-10.666667h140.8V320c0 17.066667 12.8 29.866667 29.866666 29.866667h277.333334c17.066667 0 29.866667-12.8 29.866666-29.866667s-12.8-29.866667-29.866666-29.866667H371.2V160h302.933333c2.133333 0 6.4 2.133333 8.533334 2.133333l179.2 179.2c2.133333 2.133333 2.133333 4.266667 2.133333 8.533334V853.333333z"
                  p-id="13842"
                />
              </svg>
              <br />Save Design
            </button>
          </li>
        </ul>
        <div class="tab-content p-2" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <h4 class="mt-3 mb-3 fw-bold">Enter Your Text Below</h4>
            <textarea
              class="mb-3"
              id="text"
              name="text"
              rows="4"
              cols="50"
              placeholder="--enter your text here--"
            ></textarea>
            <button class="btn btn-lg btn-dark">Add to design</button>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.drawing-area {
  position: absolute;
  top: 60px;
  left: 150px;
  z-index: 10;
  width: 200px;
  height: 400px;
}

.canvas-container {
  width: 200px;
  height: 400px;
  position: relative;
  user-select: none;
}

#tshirt-div {
  width: 452px;
  height: 548px;
  position: relative;
  background-color: #fff;
}

#canvas {
  position: absolute;
  width: 225px;
  height: 300px;
  border: 1px solid black;
  left: 0px;
  top: 0px;
  user-select: none;
  cursor: default;
}
</style>
<script>
import { fabric } from "fabric";
// import { saveAs } from "file-saver";
// import domtoimage from "dom-to-image";
import "fabric-history";
let canvas = null;
export default {
  data() {
    return {};
  },
  mounted() {
    canvas = new fabric.Canvas("canvas");
    var circle = new fabric.Circle({
      radius: 50,
      stroke: "green",
      strokeWidth: 3,
    });

    // Render the circle in canvas
    canvas.add(circle);
    canvas.renderAll();
  },
  methods: {},
};
</script>