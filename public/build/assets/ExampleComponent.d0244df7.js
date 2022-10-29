import { o as openBlock, c as createElementBlock, a as createStaticVNode } from "./app.d71ebcff.js";
const _export_sfc = (sfc, props) => {
  const target = sfc.__vccOpts || sfc;
  for (const [key, val] of props) {
    target[key] = val;
  }
  return target;
};
const _sfc_main = {
  mounted() {
    console.log("Component mounted.");
  }
};
const _hoisted_1 = { class: "container" };
const _hoisted_2 = /* @__PURE__ */ createStaticVNode('<div class="row justify-content-center"><div class="col-md-8"><div class="card"><div class="card-header">Example Component</div><div class="card-body"> I&#39;m an example component. </div></div></div></div>', 1);
const _hoisted_3 = [
  _hoisted_2
];
function _sfc_render(_ctx, _cache, $props, $setup, $data, $options) {
  return openBlock(), createElementBlock("div", _hoisted_1, _hoisted_3);
}
const ExampleComponent = /* @__PURE__ */ _export_sfc(_sfc_main, [["render", _sfc_render]]);
export {
  ExampleComponent as default
};
