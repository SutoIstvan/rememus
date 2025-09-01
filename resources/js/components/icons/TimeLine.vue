<template>
    <section class="pb-16 md:pb-20 lg:pb-[90px] xl:pb-[100px] bg-white dark:bg-black">
        <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto px-4 md:px-6 lg:px-8">
            <div class="text-center space-y-5 mx-auto">

                <!-- Заголовок -->
                <div class="text-center space-y-5 mx-auto md:mb-[80px]"
                    v-scroll-animate="{ delay: 50, direction: 'down' }">
                    <span class="badge badge-green">Timeline</span>
                </div>

                <div class="relative mx-auto max-w-4xl">
                    <!-- Vertical line -->
                    <div class="bg-muted absolute left-4 top-4 w-px h-full" />

                    <div v-for="(entry, index) in timelineData" :key="index" class="relative mb-10 pl-8">
                        <!-- Timeline icon -->
                        <div
                            class="bg-primary absolute left-0 top-3.5 flex size-8 items-center justify-center rounded-full border-2 border-background"
                            style="    background-color: #e8fbc6;">
                            <svg class="w-4 h-4 text-primary-foreground" fill="#1a1a1c" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <h4 class="text-start rounded-xl py-2 text-xl font-bold tracking-tight xl:mb-4 xl:px-3">
                            {{ entry.title }}
                        </h4>
                        <h5
                            class="text-end text-md -left-34 text-muted-foreground top-3 rounded-xl tracking-tight xl:absolute">
                            {{ entry.date }}
                        </h5>

                        <!-- Card component -->
                        <div class="my-5 border-none shadow-none">
                            <div class="px-0 xl:px-2">
                                <div class="text-start ms-4 prose dark:prose-invert text-foreground">
                                    {{ entry.content }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
interface TimelineEntry {
    date: string;
    title: string;
    content: string;
}

const timelineData: TimelineEntry[] = [
    {
        date: "1956",
        title: "The Birth of AI",
        content:
            "The term 'Artificial Intelligence' was coined at the Dartmouth Conference, marking the official beginning of AI as a field. John McCarthy, Marvin Minsky, Nathaniel Rochester, and Claude Shannon organized this seminal event, setting the stage for decades of research and development.",
    },
    {
        date: "1966-1973",
        title: "Early Optimism and First AI Winter",
        content:
            "The early years saw significant optimism with programs like ELIZA (the first chatbot) and SHRDLU (a natural language understanding system). However, by the early 1970s, funding dried up as researchers faced the limitations of early computing power and the complexity of human intelligence.",
    },
    {
        date: "1980-1987",
        title: "Expert Systems and Revival",
        content:
            "AI experienced a revival with the development of expert systems like MYCIN (for medical diagnosis) and DENDRAL (for chemical analysis). These systems used rule-based approaches to mimic human decision-making in specific domains, leading to renewed interest and funding in AI research.",
    },
    {
        date: "1997",
        title: "Deep Blue Defeats Chess Champion",
        content:
            "IBM's Deep Blue became the first computer system to defeat a reigning world chess champion, Garry Kasparov, in a six-game match. This milestone demonstrated AI's potential to outperform humans in complex strategic games and captured the public's imagination.",
    },
];
</script>

<style scoped>
/* Дополнительные стили при необходимости */
</style>