<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { create as createMemorial, edit as editMemorial, destroy as destroyMemorial } from '@/routes/memorial';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { h, ref } from 'vue';
import {
    ColumnDef,
    ColumnFiltersState,
    ExpandedState,
    SortingState,
    VisibilityState,
    getCoreRowModel,
    getExpandedRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable,
    FlexRender,
} from '@tanstack/vue-table';
import {
    ArrowUpDown,
    ChevronDown,
    MoreHorizontal,
    Plus
} from 'lucide-vue-next';

import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Input } from '@/components/ui/input';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { valueUpdater } from '@/lib/utils'; // Make sure this exists, or implement it locally

interface Memorial {
    id: number;
    slug: string | null;
    name: string;
    birth_date: string | null;
    death_date: string | null;
    photo: string | null;
}

const props = defineProps<{
    memorials: Memorial[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const columns: ColumnDef<Memorial>[] = [
    {
        accessorKey: 'name',
        header: ({ column }) => {
            return h(Button, {
                variant: 'ghost',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
        },
        cell: ({ row }) => h('div', { class: 'font-medium' }, row.getValue('name')),
    },
    {
        accessorKey: 'birth_date',
        header: 'Birth Date',
        cell: ({ row }) => h('div', row.getValue('birth_date') || '-'),
    },
    {
        accessorKey: 'death_date',
        header: 'Death Date',
        cell: ({ row }) => h('div', row.getValue('death_date') || '-'),
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const memorial = row.original;

            return h(DropdownMenu, {}, {
                default: () => [
                    h(DropdownMenuTrigger, { asChild: true }, () =>
                        h(Button, { variant: 'ghost', class: 'h-8 w-8 p-0' }, () => [
                            h('span', { class: 'sr-only' }, 'Open menu'),
                            h(MoreHorizontal, { class: 'h-4 w-4' })
                        ])
                    ),
                    h(DropdownMenuContent, { align: 'end' }, () => [
                        h(DropdownMenuLabel, 'Actions'),
                        h(DropdownMenuItem, () => h(Link, { href: editMemorial.url({ memorial: String(memorial.slug || memorial.id) }) }, 'Edit')),
                        h(DropdownMenuItem, () => h(Link, { href: `/memorial/${memorial.slug || memorial.id}`, target: '_blank' }, 'View Page')),
                        h(DropdownMenuSeparator),
                        h(DropdownMenuItem, () => h(Link, {
                            href: destroyMemorial.url({ memorial: String(memorial.slug || memorial.id) }),
                            method: 'delete',
                            as: 'button',
                            class: 'w-full text-left text-red-600 focus:text-red-600'
                        }, 'Delete')),
                    ])
                ]
            });
        },
    },
];

const sorting = ref<SortingState>([]);
const columnFilters = ref<ColumnFiltersState>([]);
const columnVisibility = ref<VisibilityState>({});
const rowSelection = ref({});

const table = useVueTable({
    get data() { return props.memorials },
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: updaterOrValue => valueUpdater(updaterOrValue, rowSelection),
    getRowId: (row) => String(row.id), // Use stable ID for keys
    state: {
        get sorting() { return sorting.value },
        get columnFilters() { return columnFilters.value },
        get columnVisibility() { return columnVisibility.value },
        get rowSelection() { return rowSelection.value },
    },
});

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Memorials</h2>
                    <p class="text-muted-foreground">Manage your memorial pages here.</p>
                </div>
                <Link :href="createMemorial.url()">
                    <Button>
                        <Plus class="mr-2 h-4 w-4" /> Create New
                    </Button>
                </Link>
            </div>

            <div class="w-full">
                <div class="flex items-center py-4">
                    <Input class="max-w-sm" placeholder="Filter names..."
                        :model-value="table.getColumn('name')?.getFilterValue() as string"
                        @update:model-value="table.getColumn('name')?.setFilterValue($event)" />
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <Button variant="outline" class="ml-auto">
                                Columns
                                <ChevronDown class="ml-2 h-4 w-4" />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuCheckboxItem
                                v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
                                :key="column.id" class="capitalize" :checked="column.getIsVisible()" @update:checked="(value) => {
                                    column.toggleVisibility(!!value)
                                }">
                                {{ column.id }}
                            </DropdownMenuCheckboxItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
                <div class="rounded-md border border-gray-200 dark:border-gray-800">
                    <Table>
                        <TableHeader>
                            <TableRow class="border-gray-200 dark:border-gray-800"
                                v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                                <TableHead class="border-gray-200 dark:border-gray-800"
                                    v-for="header in headerGroup.headers" :key="header.id">
                                    <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                                        :props="header.getContext()" />
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody class="border-gray-200 dark:border-gray-800">
                            <template v-if="table.getRowModel().rows?.length">
                                <TableRow class="border-gray-200 dark:border-gray-800"
                                    v-for="row in table.getRowModel().rows" :key="row.id"
                                    :data-state="row.getIsSelected() && 'selected'">
                                    <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                        <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                                    </TableCell>
                                </TableRow>
                            </template>
                            <TableRow v-else>
                                <TableCell :colspan="columns.length" class="h-24 text-center">
                                    No results.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>

                <div class="flex items-center justify-end space-x-2 py-4">
                    <div class="flex-1 text-sm text-muted-foreground">
                        {{ table.getFilteredSelectedRowModel().rows.length }} of
                        {{ table.getFilteredRowModel().rows.length }} row(s) selected.
                    </div>
                    <div class="space-x-2">
                        <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()"
                            @click="table.previousPage()">
                            Previous
                        </Button>
                        <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()"
                            @click="table.nextPage()">
                            Next
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
