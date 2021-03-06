<div class="field">
    <div class="dropdown is-hoverable">
        <div class="dropdown-trigger">
            <button class="button is-large">
                <span v-html="activeInstructions"></span>
                <span class="icon has-text-weight-semibold">
                    &or;
                </span>
            </button>
        </div>
        <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content">
                <a v-for="(item, index) in instructions" href="#" class="dropdown-item"
                   :class="{ 'is-active' : activeInstructions === item}" @click="activeInstructions = item">
                    @{{item}}
                </a>
            </div>
        </div>
    </div>
</div>
