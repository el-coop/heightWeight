<bulma-accordion-item>
    <h4 slot="title">Step 1</h4>
    <div class="content" slot="content">
        <p>
            Copy this code.
            <button class="button is-dark is-small"
                    type="button"
                    v-clipboard:copy="message"
                    v-clipboard:success="onCopy"
                    v-clipboard:error="onError">
                Click to copy
            </button>
        </p>

        <code class="is-block" id="install-code" v-pre>
            &lt;div id="height_and_weight"&gt;&lt;/div&gt;<br>
            {% assign height_and_weight_app_data = product.metafields.height_weight %}<br>
            &lt;input type="hidden"<br>
            value='@{{ height_and_weight_app_data["height_and_weight_app_data"] }}'<br>
            name="hidden_metafiled"<br>
            class="height_weight_hide_meta"&gt;<br>
        </code>
    </div>
</bulma-accordion-item>