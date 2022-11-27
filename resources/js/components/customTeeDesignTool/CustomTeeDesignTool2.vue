<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-1 shadow p-2 bg-body rounded bg-white pt-3">
        <div class="row mb-5 gy-2">
          <div class="col-12 btn border-0 text-center" @click="undo">
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
          <div class="col-12 btn border-0 text-center" @click="redo">
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
        <div class="mt-5 row gy-3">
          <div class="col-12 text-center">
            <button
              class="btn btn-sm"
              :class="isActive?'btn-dark':'btn-secondary'"
              @click="toggle"
            >View Front/Back</button>
          </div>
          <div class="col-12 text-center">
            <p class>
              <u>Viewing {{frontOrBack}}</u>
            </p>
          </div>
          <div class="col-12 btn border-0 text-center">
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
        <div id="tshirt-div" :style="{'background-color':ptColor}">
          <!-- 
        Initially, the image will have the background tshirt that has transparency
        So we can simply update the color with CSS or JavaScript dinamically
          -->
          <img
            v-if="isActive"
            id="tshirt-backgroundpicture"
            src="../../../../public/image/crew_front.png"
          />
          <img v-else id="tshirt-backgroundpicture" src="../../../../public/image/crew_back.png" />

          <!-- 
        The container where Fabric.js will work. Notice that in the the style of #canvas
        the width and height need to match with the attributes
          -->
          <div v-show="isActive" id="drawingArea" class="drawing-area">
            <div class="canvas-container mt-5">
              <canvas class="canvas" id="canvas1" width="225" height="300"></canvas>
            </div>
          </div>
          <div v-show="!isActive" id="drawingArea" class="drawing-area">
            <div class="canvas-container mt-5">
              <canvas class="canvas" id="canvas2" width="225" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5 bg-white pt-2 pe-2">
        <div class="d-flex flex-row border b-1 mb-3 shadow p-2 bg-body rounded">
          <button class="btn border-0 p-2 flex-fill text-center" @click="group">
            <svg
              t="1669273473900"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="9909"
              width="25"
              height="25"
            >
              <path
                d="M912 820.1V203.9c28-9.9 48-36.6 48-67.9 0-39.8-32.2-72-72-72-31.3 0-58 20-67.9 48H203.9C194 84 167.3 64 136 64c-39.8 0-72 32.2-72 72 0 31.3 20 58 48 67.9v616.2C84 830 64 856.7 64 888c0 39.8 32.2 72 72 72 31.3 0 58-20 67.9-48h616.2c9.9 28 36.6 48 67.9 48 39.8 0 72-32.2 72-72 0-31.3-20-58-48-67.9zM888 112c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zM136 912c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24z m0-752c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24z m704 680H184V184h656v656z m48 72c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zM288 474h448c8.8 0 16-7.2 16-16V282c0-8.8-7.2-16-16-16H288c-8.8 0-16 7.2-16 16v176c0 8.8 7.2 16 16 16z m56-136h336v64H344v-64z m-56 420h448c8.8 0 16-7.2 16-16V566c0-8.8-7.2-16-16-16H288c-8.8 0-16 7.2-16 16v176c0 8.8 7.2 16 16 16z m56-136h336v64H344v-64z"
                p-id="9910"
              />
            </svg>
            <br />Group
          </button>
          <button class="btn border-0 p-2 flex-fill text-center" @click="ungroup">
            <svg
              t="1669273533490"
              class="icon"
              viewBox="0 0 1024 1024"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              p-id="12344"
              width="25"
              height="25"
            >
              <path
                d="M937.791569 480.809627l0 251.933893 50.386574 0L988.178143 883.904265 837.017398 883.904265l0-50.386574L484.310358 833.517691l0 50.386574L333.149613 883.904265 333.149613 732.74352l50.386574 0 0-50.386574L232.376465 682.356946l0 50.386574L81.21572 732.74352 81.21572 581.583798l50.386574 0L131.602294 329.649905 81.21572 329.649905 81.21572 178.48916 232.376465 178.48916l0 50.386574 352.707041 0 0-50.386574 151.160745 0 0 151.160745-50.386574 0 0 50.386574L837.017398 380.036479l0-50.386574 151.160745 0 0 151.160745L937.791569 480.81065zM131.602294 279.262308l50.386574 0L181.988868 228.875734l-50.386574 0L131.602294 279.262308zM181.989891 631.970372l-50.386574 0 0 50.386574 50.386574 0L181.989891 631.970372zM585.083505 631.970372l0-50.386574 50.386574 0L635.470079 329.649905l-50.386574 0 0-50.386574L232.376465 279.263331l0 50.386574-50.386574 0 0 251.933893 50.386574 0 0 50.386574L585.083505 631.970372zM433.923784 783.130094l-50.386574 0 0 50.386574 50.386574 0L433.923784 783.130094zM887.403972 480.809627 837.017398 480.809627l0-50.386574L685.857676 430.423053l0 151.160745 50.386574 0 0 151.160745L585.083505 732.744543l0-50.386574L433.923784 682.357969l0 50.386574 50.386574 0 0 50.386574L837.017398 783.131117l0-50.386574 50.386574 0L887.403972 480.809627zM635.470079 279.262308l50.386574 0L685.856653 228.875734l-50.386574 0L635.470079 279.262308zM635.470079 631.970372l0 50.386574 50.386574 0 0-50.386574L635.470079 631.970372zM887.403972 430.423053l50.386574 0 0-50.386574-50.386574 0L887.403972 430.423053zM937.791569 783.130094l-50.386574 0 0 50.386574 50.386574 0L937.791569 783.130094z"
                p-id="12345"
                fill="#2c2c2c"
              />
            </svg>
            <br />Ungroup
          </button>
          <button class="btn border-0 p-2 text-center flex-fill bd-highlight" @click="sendingFront">
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
          </button>
          <button class="btn border-0 p-2 text-center flex-fill bd-highlight" @click="sendingBack">
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
          </button>
          <button
            class="btn border-0 p-2 flex-fill text-center"
            data-bs-toggle="modal"
            data-bs-target="#exampleModalCenter"
          >
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
          </button>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="text-tab"
              data-bs-toggle="tab"
              data-bs-target="#text"
              type="button"
              role="tab"
              aria-controls="text"
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
              id="shape-tab"
              data-bs-toggle="tab"
              data-bs-target="#shape"
              type="button"
              role="tab"
              aria-controls="shape"
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
              id="design-tab"
              data-bs-toggle="tab"
              data-bs-target="#design"
              type="button"
              role="tab"
              aria-controls="design"
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
              id="save-tab"
              data-bs-toggle="tab"
              data-bs-target="#save"
              type="button"
              role="tab"
              aria-controls="save"
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
        <div class="tab-content p-1" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="text"
            role="tabpanel"
            aria-labelledby="text-tab"
          >
            <h4 class="mt-3 mb-3 fw-bold">Enter Your Text Below</h4>
            <textarea
              class="mb-3"
              v-model="text"
              id="text"
              name="text"
              rows="4"
              cols="50"
              placeholder="--enter your text here--"
            ></textarea>
            <button class="btn btn-lg btn-dark" @click="addText">Add to design</button>
          </div>
          <div class="tab-pane fade" id="shape" role="tabpanel" aria-labelledby="shape-tab">
            <p class="mt-1 mb-3">Select a shape and add to canvas.</p>
            <select
              v-model="selected"
              class="form-select form-select-md less-w mb-3"
              aria-label=".form-select-sm shape-select"
            >
              <option selected value>Select a shape</option>
              <option value="1">Circle</option>
              <option value="2">Ellipse</option>
              <option value="3">Line</option>
              <option value="4">Polygon</option>
              <option value="5">Rectangle</option>
              <option value="6">Triangle</option>
            </select>

            <button class="btn btn-lg btn-dark" @click="addShape">Add to design</button>
          </div>
          <div class="tab-pane fade" id="design" role="tabpanel" aria-labelledby="design-tab">design</div>
          <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-tab">
            <p class="mt-1 mb-3">Enter a name for your design and then click the save button.</p>
            <div class="input-group mb-3">
              <input
                type="text"
                v-model="saveName"
                class="form-control bg-white me-4"
                placeholder="Type your design name here"
              />
            </div>
            <button class="btn btn-lg btn-dark" @click="saveCanvas">Save Design</button>
            <p class="mt-3 mb-2">Below is the product information.</p>

            <div class="info">
              <h4 class="mb-3 fw-bold">{Gildan}{Cotton}</h4>
              <p class="mb-1">
                <b>Detail</b> Long 123
              </p>
              <p class="mb-1">
                <span class="fw-bold">Plain-Tee Price</span> RM 15.00
              </p>
              <p class="mb-3 fst-italic text-secondary">
                <b>(*price does not included printing price and delivery price)</b>
                <br />
                <b>(*go to my design page to proceed with ordering)</b>
              </p>
              <p class="mb-1">
                <b>Description</b>
              </p>
              <p class="mb-1">
                1231231231231231231sadasdasdasdas dasdas dasdsad
                asdasdasd
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <br />
    <br />
    <img id="img1" :src="imgTest1" alt="ntg" />
    <img id="img2" :src="imgTest2" alt="ntg" />

    <!-- start modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      aria-labelledby="exampleModalCenterTitle"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Upload Image</h5>
            <button
              ref="btnClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="clearUploadImage"
            ></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Upload your file here.</label>
                    <input
                      @change="uploadImage"
                      ref="imgFile"
                      class="form-control"
                      :class="checkShowValidOrInvalid"
                      type="file"
                      id="imgFile"
                    />
                    <div id="validationServer05Feedback" class="invalid-feedback">
                      <div
                        class="error-msg"
                        v-for="errorMsg in imgErrorMsgs"
                        :key="errorMsg"
                      >{{ errorMsg }}</div>
                    </div>
                    <div id="validationServer05Feedback" class="valid-feedback">Valid Image</div>
                  </div>
                </div>
                <div class="col-6">
                  <h5 class="fw-bold">We accept the following file type</h5>
                  <p class="text-secondary">JPG, PNG and SVG</p>
                  <h5 class="fw-bold">10 MB maximum file size</h5>
                  <p
                    class="text-secondary"
                  >Files may take anywhere from a few seconds to a few minutes to upload.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              :disabled="disableBtn"
              @click="confirmUploadImg"
            >Confirm Upload</button>
          </div>
        </div>
      </div>
      <!-- end modal -->
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
  width: 500px;
  height: 570px;
  position: relative;
  background-color: #fff;
}

.canvas {
  position: absolute;
  width: 225px;
  height: 300px;
  border: 1px solid black;
  left: 0px;
  top: 0px;
  user-select: none;
  cursor: default;
}

.div-hover {
  color: blue;
  opacity: 0.5;
}

.tab-pane {
  height: 350px;
  overflow-y: auto;
  overflow-x: hidden;
  width: 100%;
}

.less-w {
  width: 350px;
}
</style>
<script>
import { fabric } from "fabric";
// import { saveAs } from "file-saver";
// import domtoimage from "dom-to-image";
import "fabric-history";
import mergeImages from "merge-images";

let canvas1 = null;
let canvas2 = null;
let maincanvas = null;
export default {
  data() {
    return {
      imgStateFront: "",
      imgStateBack: "",
      imgMergedFront: require("../../../../public/image/crew_front.png"),
      imgMergedBack: require("../../../../public/image/crew_back.png"),
      isActive: true,
      frontOrBack: "Front",
      imgTest1: "",
      imgTest2: "",
      text: "",
      saveName: "",
      frontDesignJson: '""',
      backDesignJson: '""',
      ptColor: "#fff",
      selected: "",
      checkIsValidSize: "",
      checkIsValidType: "",
      imgErrorMsgs: [],
      hasImage: false,
      disableBtn: true,
      imgFileExt: "",
      selectedFileImg: null,
      customTee: {
        ptTypeColorID: "",
        cusID: "",
        name: "",
        frontDesignImg: "",
        backDesignImg: "",
        frontDesignJson: '""',
        backDesignJson: '""',
      },
    };
  },
  mounted() {
    canvas1 = new fabric.Canvas("canvas1", { preserveObjectStacking: true });
    canvas2 = new fabric.Canvas("canvas2", { preserveObjectStacking: true });

    this.loadCanvas(canvas1, this.frontDesignJson);
    this.loadCanvas(canvas2, this.backDesignJson);

    maincanvas = canvas1;

    var circle1 = new fabric.Circle({
      radius: 50,
      fill: "white",
      stroke: "green",
      strokeWidth: 3,
      top: fabric.util.getRandomInt(25, maincanvas.height - 25),
      left: fabric.util.getRandomInt(25, maincanvas.width - 25),
    });

    // //listening the object and prevent moving out of the canvas
    // canvas.on("object:moving", function (e) {
    //   var obj = e.target;
    //   // if object is too big ignore
    //   if (
    //     obj.currentHeight > obj.canvas.height ||
    //     obj.currentWidth > obj.canvas.width
    //   ) {
    //     return;
    //   }
    //   obj.setCoords();
    //   // top-left  corner
    //   if (obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0) {
    //     obj.top = Math.max(obj.top, obj.top - obj.getBoundingRect().top);
    //     obj.left = Math.max(obj.left, obj.left - obj.getBoundingRect().left);
    //   }
    //   // bot-right corner
    //   if (
    //     obj.getBoundingRect().top + obj.getBoundingRect().height >
    //       obj.canvas.height ||
    //     obj.getBoundingRect().left + obj.getBoundingRect().width >
    //       obj.canvas.width
    //   ) {
    //     obj.top = Math.min(
    //       obj.top,
    //       obj.canvas.height -
    //         obj.getBoundingRect().height +
    //         obj.top -
    //         obj.getBoundingRect().top
    //     );
    //     obj.left = Math.min(
    //       obj.left,
    //       obj.canvas.width -
    //         obj.getBoundingRect().width +
    //         obj.left -
    //         obj.getBoundingRect().left
    //     );
    //   }
    // });

    // var left1 = 0;
    // var top1 = 0;
    // var scale1x = 0;
    // var scale1y = 0;
    // var width1 = 0;
    // var height1 = 0;
    // canvas.on("object:scaling", function (e) {
    //   var obj = e.target;
    //   obj.setCoords();
    //   var brNew = obj.getBoundingRect();

    //   if (
    //     brNew.width + brNew.left >= obj.canvas.width ||
    //     brNew.height + brNew.top >= obj.canvas.height ||
    //     brNew.left < 0 ||
    //     brNew.top < 0
    //   ) {
    //     obj.left = left1;
    //     obj.top = top1;
    //     obj.scaleX = scale1x;
    //     obj.scaleY = scale1y;
    //     obj.width = width1;
    //     obj.height = height1;
    //   } else {
    //     left1 = obj.left;
    //     top1 = obj.top;
    //     scale1x = obj.scaleX;
    //     scale1y = obj.scaleY;
    //     width1 = obj.width;
    //     height1 = obj.height;
    //   }
    // });

    // create a rect object
    var deleteIcon =
      "data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23F44336;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";

    var img = document.createElement("img");
    img.src = deleteIcon;

    fabric.Object.prototype.transparentCorners = false;
    fabric.Object.prototype.cornerColor = "black";
    fabric.Object.prototype.cornerStyle = "circle";

    fabric.Object.prototype.controls.deleteControl = new fabric.Control({
      x: -0.5,
      y: -0.5,
      offsetY: -16,
      offsetX: -16,
      cursorStyle: "pointer",
      mouseUpHandler: deleteObject,
      render: renderIcon,
      cornerSize: 24,
    });

    function deleteObject(eventData, transform) {
      var target = transform.target;
      var canvas = target.canvas;
      canvas.remove(target);
      canvas.requestRenderAll();
    }

    function renderIcon(ctx, left, top, styleOverride, fabricObject) {
      var size = this.cornerSize;
      ctx.save();
      ctx.translate(left, top);
      ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
      ctx.drawImage(img, -size / 2, -size / 2, size, size);
      ctx.restore();
    }

    // Render the circle in canvas
    maincanvas.add(circle1);
    maincanvas.renderAll();

    //Event
    //when the object selected the created event will trigger
    //when the second, third and so on is selected then updated event will trigger
    maincanvas.on({
      "selection:updated": this.onSelectedObj,
      "selection:created": this.onSelectedObj,
    });
  },
  methods: {
    toggle() {
      this.isActive = !this.isActive;
      maincanvas = this.isActive ? canvas1 : canvas2;
      console.log(maincanvas);
      this.frontOrBack = this.isActive ? "Front" : "Back";
    },
    addText() {
      //used to add text to canvas
      //Checked undefined, null, NaN, 0, "" (empty string) or false
      if (!this.text || this.text.match(/^\s|\s$/)) {
        alert("Text cannot empty and included space at front and back!!");
        return;
      }

      //trim used to remove front and back empty space
      let iText = new fabric.IText(this.text.trim());
      //Add created text to canvas and set as active object
      maincanvas.add(iText).setActiveObject(iText);
      //Set the text field to empty
      this.text = "";
    },
    addShape() {
      let shape = this.selected;

      switch (shape) {
        case "1": //circle
          var circle = new fabric.Circle({
            radius: 50,
            stroke: "green",
            strokeWidth: 3,
          });
          maincanvas.add(circle);
          maincanvas.renderAll();
          break;
        case "2": //ellipse
          var ellipse = new fabric.Ellipse({
            rx: 80,
            ry: 40,
            fill: "",
            stroke: "green",
            strokeWidth: 3,
          });
          maincanvas.add(ellipse);
          maincanvas.renderAll();
          break;
        case "3": //line
          var line = new fabric.Line([50, 100, 200, 200], {
            stroke: "green",
          });
          maincanvas.add(line);
          maincanvas.renderAll();
          break;
        case "4": //polygon
          var polygon = new fabric.Polygon(
            [
              { x: 200, y: 10 },
              { x: 250, y: 50 },
              { x: 250, y: 180 },
              { x: 150, y: 180 },
              { x: 150, y: 50 },
            ],
            {
              stroke: "green",
              strokeWidth: 3,
            }
          );
          maincanvas.add(polygon);
          maincanvas.renderAll();
          break;
        case "5": //rectangle
          var rect = new fabric.Rect({
            width: 100,
            height: 100,
            fill: "blue",
            opacity: 1,
            left: 0,
            top: 0,
          });
          maincanvas.add(rect);
          maincanvas.renderAll();
          break;
        case "6": //triangle
          var triangle = new fabric.Triangle({
            width: 150,
            height: 100,
            fill: "",
            stroke: "green",
            strokeWidth: 3,
          });
          maincanvas.add(triangle);
          maincanvas.renderAll();
          break;
      }
    },
    onSelectedObj() {
      //used to check which obj is selected and take action
      let selectedActiveObj = maincanvas.getActiveObject();

      console.log(selectedActiveObj.type);
      // switch (selectedActiveObj.type) {
      //   case "activeSelection":
      //     this.isGroup = true;
      // }
    },
    saveCanvas() {
      //havent done
      //check empty, undifined, null or included spacing
      if (!this.saveName || /\s+/g.test(this.saveName)) {
        alert("Text cannot empty and cannot include spacing");
        return;
      }

      this.saveName = this.saveName.trim();
      this.frontDesignJson = canvas1.toJSON();
      this.imgStateFront = canvas1.toDataURL({
        format: "png",
        left: 0,
        top: 0,
        width: maincanvas.width,
        height: maincanvas.height,
      });

      this.backDesignJson = canvas2.toJSON();
      this.imgStateBack = canvas2.toDataURL({
        format: "png",
        left: 0,
        top: 0,
        width: maincanvas.width,
        height: maincanvas.height,
      });

      let imgPath = "";

      imgPath = require("../../../../public/image/crew_front.png");
      this.imgMergedFront = this.combineImages(imgPath, this.imgStateFront);

      imgPath = require("../../../../public/image/crew_back.png");
      this.imgMergedBack = this.combineImages(imgPath, this.imgStateBack);

      Promise.all([this.imgMergedFront, this.imgMergedBack]).then((b64) => {
        this.imgTest1 = b64[0];
        this.imgTest2 = b64[1];

        //send post request to save the customTee design
        //in here post the data to backend then return success or failed status
        this.customTee.name = this.saveName;
        this.customTee.frontDesignImg = b64[0];
        this.customTee.backDesignImg = b64[1];
        this.customTee.frontDesignJson = this.frontDesignJson;
        this.customTee.backDesignJson = this.backDesignJson;

        alert("Success Saved");
      });
    },
    loadCanvas(canvas, jsonDesign) {
      canvas.loadFromJSON(jsonDesign, canvas.renderAll.bind(canvas));
    },
    undo() {
      maincanvas.undo();
    },
    redo() {
      maincanvas.redo();
    },
    combineImages(frontOrBackImg, dataURL) {
      //after combine return the promise obj and included base64
      return mergeImages(
        [
          frontOrBackImg,
          {
            src: dataURL,
            x: 150,
            y: 110,
          },
        ],
        {
          quality: 0.92,
        }
      );
    },
    group() {
      if (!maincanvas.getActiveObject()) {
        return;
      }
      if (maincanvas.getActiveObject().type !== "activeSelection") {
        return;
      }
      maincanvas.getActiveObject().toGroup();
      maincanvas.requestRenderAll();
    },
    ungroup() {
      if (!maincanvas.getActiveObject()) {
        return;
      }
      if (maincanvas.getActiveObject().type !== "group") {
        return;
      }
      maincanvas.getActiveObject().toActiveSelection();
      maincanvas.discardActiveObject();
      maincanvas.requestRenderAll();
    },
    sendingFront() {
      if (!maincanvas.getActiveObject()) {
        return;
      }
      maincanvas.bringToFront(maincanvas.getActiveObject());
      maincanvas.requestRenderAll();
    },
    sendingBack() {
      if (!maincanvas.getActiveObject()) {
        return;
      }
      maincanvas.sendToBack(maincanvas.getActiveObject());
      maincanvas.requestRenderAll();
    },
    checkExtension(file) {
      var str = file.split(".");
      console.log(str);
      return str[str.length - 1];
    },
    isImage(file) {
      var ext = this.checkExtension(file.name);
      console.log(ext);
      switch (ext.toLowerCase()) {
        case "jpg":
        case "jpeg":
        case "png":
        case "svg":
          return true;
      }
      return false;
    },
    exceedImgSize(file) {
      const fileSize = file.size / 1024 / 1024; // in MiB

      console.log(fileSize);

      return !(fileSize > 10) ? true : false; // not greater than 10MB
    },
    uploadImage(e) {
      this.selectedFileImg = e.target.files[0];

      this.imgErrorMsgs = [];

      if (this.selectedFileImg) {
        console.log("has img");
        this.hasImage = true;
        this.imgFileExt = this.checkExtension(
          this.selectedFileImg.name
        ).toLowerCase();
        if (!this.isImage(this.selectedFileImg)) {
          this.imgErrorMsgs.push("Invalid file types;");
        }

        if (!this.exceedImgSize(this.selectedFileImg)) {
          this.imgErrorMsgs.push("Invalid file size exceed 10MB;");
        }
      } else {
        this.hasImage = false;
      }

      this.disablingBtn();
    },
    confirmUploadImg() {
      console.log("I am in");

      const url = URL.createObjectURL(this.selectedFileImg);
      var imgFileExts = ["jpg", "jpeg", "png"];

      if (imgFileExts.includes(this.imgFileExt)) {
        console.log(this.imgFileExt);
        fabric.Image.fromURL(url, function (img) {
          img.scaleToWidth(100);
          img.scaleToHeight(100);
          maincanvas.add(img).renderAll;
        });
      }

      if (this.imgFileExt == "svg") {
        console.log(this.imgFileExt);
        fabric.loadSVGFromURL(url, function (objects, options) {
          var obj = fabric.util.groupSVGElements(objects, options);
          obj.scaleToWidth(100);
          obj.scaleToHeight(100);
          maincanvas.add(obj).renderAll;
        });
      }

      this.$refs.btnClose.click();
    },
    clearUploadImage() {
      this.$refs.imgFile.value = "";
      this.imgFileExt = "";
      this.hasImage = false;
      this.imgErrorMsgs = [];
    },
    disablingBtn() {
      if (this.hasImage == false) {
        this.disableBtn = true;
      }
      if (this.imgErrorMsgs.length >= 1) {
        this.disableBtn = true;
      }
      if (this.imgErrorMsgs.length == 0) {
        this.disableBtn = false;
      }
    },
  },
  computed: {
    checkShowValidOrInvalid() {
      if (this.hasImage == false) {
        return "";
      }

      if (this.imgErrorMsgs.length >= 1) {
        return "is-invalid";
      }
      if (this.imgErrorMsgs.length == 0) {
        return "is-valid";
      }
      return "";
    },
  },
};
</script>