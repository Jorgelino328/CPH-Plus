<template>
    <div class="bg-grey-darken-3 pa-4 mb-10 rounded-lg">
        <h1 class="text-h6 mb-3">
            {{ paste.title }}
        </h1>

        <v-chip
            variant="outlined"
        >
            <v-icon start icon="mdi-text"/>
            {{ paste.syntax_highlight?.label ?? 'Platin text' }}
        </v-chip>
        <v-chip
            variant="outlined"
            class="ml-2"
        >
            <v-icon start icon="mdi-calendar"/>
            {{ paste.created_at }}
        </v-chip>
        <v-chip
            variant="outlined"
            class="ml-2"
        >
            <v-icon start icon="mdi-timer-alert-outline"/>
            {{ paste.expiration ?? 'Never' }}
        </v-chip>

        <span v-if="paste.tags" class="ml-2">
            Tags:
            <v-chip
                v-for="(tag, i) in paste.tags"
                :key="tag"
                size="small"
            >
                <template #prepend>
                    <v-avatar
                        :class="`bg-${getTagColor(i)} text-uppercase text-white`"
                        start
                    >
                        {{ tag.slice(0, 1) }}
                    </v-avatar>
                </template>
                {{ tag }}
            </v-chip>
        </span>

        <highlightjs
            :autodetect="false"
            :language="paste.syntax_highlight?.value ?? 'plaintext'"
            :code="paste.content"
            class="mt-4 overflow-auto rounded-lg"
        />
    </div>
</template>

<script setup lang="ts">
const route = useRoute()

const { data: paste } = await useAsyncData(
    'paste',
    () => useApi('pastes/' + route.params.id, { method: 'POST' }))

function getTagColor(index: number): string
{
    const colors = ['red', 'green', 'blue', 'orange', 'purple']
    return colors[index % colors.length]
}
</script>
