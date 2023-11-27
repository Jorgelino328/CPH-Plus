<template>
    <div class="bg-grey-darken-3 pa-4 mb-10 rounded-lg">
        <h1 class="text-h6">
            Create a new paste
            <v-btn
                variant="outlined"
                label="Preview highlighted"
                color="white"
                class="ml-2 text-body-2"
                :disabled="paste.syntax_highlight === null"
                @click="showHighlightPreview"
            >
                PREVIEW HIGHLIGHTED
            </v-btn>
        </h1>

        <v-form fast-fail @submit.prevent="createPaste">
            <v-textarea
                v-model="paste.content"
                rows="10"
                class="mt-5"
                :spellcheck="false"
                :rules="[validation.required]"
            />

            <v-row>
                <v-col cols="8" offset="2">
                    <v-dialog
                        v-model="previewHighlight"
                        width="60%"
                        theme="light"
                    >
                        <highlightjs
                            :autodetect="false"
                            :language="paste.syntax_highlight"
                            :code="paste.content"
                            class="overflow-auto rounded-lg"
                        />
                    </v-dialog>
        
                    <v-text-field
                        v-model="paste.title"
                        counter
                        variant="outlined"
                        label="Title"
                        density="compact"
                        maxlength="50"
                        :rules="[validation.required]"
                    />

                    <v-combobox
                        v-model="paste.tags"
                        label="Tags"
                        variant="outlined"
                        counter
                        maxlength="10"
                        multiple
                    >
                        <template #selection="data">
                            <v-chip
                                size="small"
                            >
                                <template #prepend>
                                    <v-avatar
                                        :class="`bg-${getTagColor(data.index)} text-uppercase text-white`"
                                        start
                                    >
                                        {{ data.item.title.slice(0, 1) }}
                                    </v-avatar>
                                </template>
                                {{ data.item.title }}
                            </v-chip>
                        </template>
                    </v-combobox>

                    <v-autocomplete
                        return-object
                        :items="syntaxHighlights"
                        item-title="label"
                        variant="outlined"
                        label="Syntax highlight"
                        density="compact"
                        @update:model-value="({ id, value }: any) => {
                            paste.syntax_highlight = value
                            paste.syntax_highlight_id = id
                        }"
                    />
                    <v-select
                        v-model="paste.seconds_to_expire"
                        :items="expirationTimes"
                        item-title="label"
                        item-value="seconds"
                        variant="outlined"
                        label="Expiration"
                        density="compact"
                    />
                    Exposure
                    <v-switch
                        v-model="paste.listable"
                        hide-details
                        :label="paste.listable ? 'Listable' : 'Non listable'"
                        color="blue-darken-1"
                    />
                    <v-checkbox
                        v-model="usePassword"
                        hide-details
                        label="Use password"
                        density="compact"
                    />
                    <v-text-field
                        v-model="paste.password"
                        variant="outlined"
                        label="Password"
                        :disabled="!usePassword"
                        density="compact"
                        class="mt-2"
                        :rules="usePassword ? [validation.minLength(8)] : []"
                    >
                        <template #append-inner>
                            <v-tooltip
                                text="Generate a random password"
                                location="bottom"
                            >
                                <template #activator="{ props }">
                                    <v-btn
                                        v-bind="props"
                                        icon="mdi-sync"
                                        variant="text"
                                        @click="setRandomPassword"
                                    />
                                </template>
                            </v-tooltip>
                        </template>
                    </v-text-field>

                    <v-checkbox
                        v-model="paste.destroy_on_open"
                        label="Destroy on open"
                        color="red"
                        density="compact"
                    />

                    <v-btn
                        color="green"
                        width="100%"
                        prepend-icon="mdi-plus"
                        type="submit"
                    >
                        Create the paste
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </div>
</template>

<script setup lang="ts">
import validation from '~/utils/validation'
const { $toast } = useNuxtApp()

const { data: syntaxHighlights } = await useAsyncData(
    'syntaxHighlights',
    () => useApi('syntax-highlights'))

const { data: expirationTimes } = await useAsyncData(
    'expirationTimes',
    () => useApi('expiration-times'))

const previewHighlight = ref(false)

const paste = ref({
    title: null,
    content: "",
    tags: [] as string[],
    syntax_highlight: null,
    syntax_highlight_id: null,
    seconds_to_expire: null,
    destroy_on_open: false,
    listable: true,
    password: null as string | null
})
const usePassword = ref(false)

function showHighlightPreview(): void
{
    if (paste.value.content.length == 0) return
    previewHighlight.value = true
}

function getTagColor(index: number): string
{
    const colors = ['red', 'green', 'blue', 'orange', 'purple']
    return colors[index % colors.length]
}

const MAXIMUM_TAGS_NUMBER = 10
const MAXIMUM_TAG_SIZE = 25

watch(
    () => paste.value.tags,
    tags => {
        if (tags.length > MAXIMUM_TAGS_NUMBER || tags.at(-1)!.length > MAXIMUM_TAG_SIZE)
        {
            nextTick(() => paste.value.tags.pop())
        }
    }
)

function setRandomPassword(): void
{
    paste.value.password = Math.random().toString(36).slice(2)
}

watch(
    usePassword,
    usePassword => {
        if (usePassword) return
        paste.value.password = null
    }
)

async function createPaste(): Promise<void>
{
    const { message } = await useApi('pastes', { method: 'POST', body: paste.value })
    $toast.success(message)
}
</script>
