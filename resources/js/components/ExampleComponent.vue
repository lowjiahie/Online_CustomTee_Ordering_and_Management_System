<template>
  <div>
    <canvas id="c" class="border border-dark" width="600" height="400"></canvas>
    <canvas id="c2" class="border border-danger" width="600" height="400"></canvas>
    <canvas id="c3" class="border border-danger" width="600" height="400"></canvas>
    <button class="btn btn-primary text-white" @click="saveCanvas()">Save</button>
    <button class="btn btn-primary text-white" @click="loadCanvas1()">Load data from canvas 1</button>
    <button class="btn btn-primary text-white" @click="loadCanvas2()">Load data from canvas 2</button>
    <button class="btn btn-primary text-white" @click="undo()">undo</button>
    <button class="btn btn-primary text-white" @click="redo()">redo</button>
    <input type="color" v-model="color" @change="updateColor" />
    <!-- <img id="img1" src alt="ntg" /> -->
    <router-link :to="{name: 'design-tool', params:{customTee:customTee} }">
        <h5 class="card-title">123</h5>
    </router-link>
  </div>
</template> 

<script>
import { fabric } from "fabric";
import "fabric-history";
import mergeImages from "merge-images";

let canvas = null;
let canvas2 = null;
let c3 = null;
export default {
  data() {
    return {
      json1: null,
      json2: null,
      color: "",
      opacity: "",
      customTee:{
        id:"1",
        test:"",
        test2:"2",
      }
    };
  },
  mounted() {
    canvas = new fabric.Canvas("c");
    canvas2 = new fabric.Canvas("c2");
    // canvas.observe("mouse:up", function (e) {
    //   mouseup(e);
    // });

    // fabric.Image.fromURL(
    //   require("../../../public/image/123.png"),
    //   function (img) {
    //     canvas.add(img);
    //   }
    // );
    fabric.Image.fromURL(
      require("../../../public/image/icecream.png"),
      function (img) {
        canvas.add(img);
      }
    );
    canvas.add(
      new fabric.Textbox("lowjiahie", {
        fill: "green",
        fontStyle: "italic",
      })
    );
    canvas.add(
      new fabric.Rect({
        left: 10,
        top: 10,
        height: 50,
        width: 50,
        fill: "green",
        stroke: "black",
      })
    );
    var circle = new fabric.Circle({
      radius: 50,
      stroke: "green",
      strokeWidth: 3,
    });

    // Render the circle in canvas
    canvas.add(circle);

    canvas2.add(circle);
    canvas2.renderAll();
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

    //
    canvas.on("object:moving", function (e) {
      var obj = e.target;
      // if object is too big ignore
      if (
        obj.currentHeight > obj.canvas.height ||
        obj.currentWidth > obj.canvas.width
      ) {
        return;
      }
      obj.setCoords();
      // top-left  corner
      if (obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0) {
        obj.top = Math.max(obj.top, obj.top - obj.getBoundingRect().top);
        obj.left = Math.max(obj.left, obj.left - obj.getBoundingRect().left);
      }
      // bot-right corner
      if (
        obj.getBoundingRect().top + obj.getBoundingRect().height >
          obj.canvas.height ||
        obj.getBoundingRect().left + obj.getBoundingRect().width >
          obj.canvas.width
      ) {
        obj.top = Math.min(
          obj.top,
          obj.canvas.height -
            obj.getBoundingRect().height +
            obj.top -
            obj.getBoundingRect().top
        );
        obj.left = Math.min(
          obj.left,
          obj.canvas.width -
            obj.getBoundingRect().width +
            obj.left -
            obj.getBoundingRect().left
        );
      }
    });

    var left1 = 0;
    var top1 = 0;
    var scale1x = 0;
    var scale1y = 0;
    var width1 = 0;
    var height1 = 0;
    canvas.on("object:scaling", function (e) {
      var obj = e.target;
      obj.setCoords();
      var brNew = obj.getBoundingRect();

      if (
        brNew.width + brNew.left >= obj.canvas.width ||
        brNew.height + brNew.top >= obj.canvas.height ||
        brNew.left < 0 ||
        brNew.top < 0
      ) {
        obj.left = left1;
        obj.top = top1;
        obj.scaleX = scale1x;
        obj.scaleY = scale1y;
        obj.width = width1;
        obj.height = height1;
      } else {
        left1 = obj.left;
        top1 = obj.top;
        scale1x = obj.scaleX;
        scale1y = obj.scaleY;
        width1 = obj.width;
        height1 = obj.height;
      }
    });
    canvas.renderAll();

    const dataURL = canvas.toDataURL({
      format: "png",
      left: 0,
      top: 0,
      width: 500,
      height: 500,
    });

    let imgT = new Image();
    imgT.src = require("../../../public/image/crew_front.png");
    imgT.decode().then(() => {
      let imgTWidth = imgT.width;
      let imgTHeight = imgT.height;

      console.log(imgTWidth);
      console.log(imgTHeight);

      const objImg = mergeImages(
        [
          require("../../../public/image/crew_front.png"),
          {
            src: dataURL,
            x: 150,
            y:150,
          },
        ],
        {
          quality: 0.92,
        }
      ).then((b64) => {
        document.querySelector("img").src = b64;
        console.log(b64);
      });
    });

    // console.log(dataURL)
    c3 = new fabric.Canvas("c3");
  },
  methods: {
    saveCanvas() {
      this.json1 = JSON.stringify(canvas.toJSON());
      this.json2 = JSON.stringify(canvas2.toJSON());
      console.log(this.json1);
      console.log(this.json2);
    },
    loadCanvas1() {
      var jsonObj1 = JSON.parse(this.json1);
      fabric.util.enlivenObjects(jsonObj1.objects, function (enlivenedObjects) {
        enlivenedObjects.forEach(function (obj, index) {
          c3.add(obj);
        });
        c3.renderAll();
      });
    },
    loadCanvas2() {
      var jsonObj2 = JSON.parse(this.json2);
      fabric.util.enlivenObjects(jsonObj2.objects, function (enlivenedObjects) {
        enlivenedObjects.forEach(function (obj, index) {
          console.log(obj);
          c3.add(obj);
        });
        c3.renderAll();
      });
    },
    undo() {
      canvas.undo();
    },
    redo() {
      canvas.redo();
    },
    updateColor() {
      var activeObject = canvas.getActiveObject();
      console.log(activeObject.get("type"));
      console.log(activeObject.isType("circle"));
      console.log(this.color);
      activeObject.set({ fill: this.color });
      canvas.renderAll();
    },
  },
};
</script>
