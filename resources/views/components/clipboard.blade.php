<TomatoClipboard :source="@js($text)" #default="{ copy, copied }">
    <button type="button" @click="copy" {{ $attributes }}>
        <div v-if="copied">
            <p class="text-success-500 font-bold text-lg">
                <i class="bx bxs-check-circle"></i>
            </p>
        </div>
        <div v-else>
            {{ $slot }}
        </div>
    </button>
</TomatoClipboard>
