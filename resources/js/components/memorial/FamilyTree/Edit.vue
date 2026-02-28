<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import { VueFlow, useVueFlow } from '@vue-flow/core'
import { markRaw } from 'vue'
import { Position } from '@vue-flow/core'
import SpecialEdge from '@/components/SpecialEdge.vue'
import SpecialNodeEdit from '@/components/SpecialNodeEdit.vue'
import { Controls } from '@vue-flow/controls'

// Props и emits
const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    },
    mainPersonName: {
        type: String,
        default: ''
    },
    mainPersonAvatar: {
        type: [File, String, null],
        default: null
    },
    initialData: {
        type: Array,
        default: () => []
    }
})

const emit = defineEmits(['update:modelValue', 'update:avatarFiles'])

const { updateNode, addNodes, setNodes, addEdges, getNodes, findNode, onPaneReady } = useVueFlow()

// Храним File объекты отдельно
const avatarFiles = ref<Map<string, File>>(new Map())

// Превью аватара главного персонажа
const mainPersonAvatarPreview = ref<string>('')

// Следим за изменением аватара главного персонажа
watch(() => props.mainPersonAvatar, (newAvatar) => {
    if (newAvatar instanceof File) {
        const reader = new FileReader()
        reader.onload = (e) => {
            mainPersonAvatarPreview.value = e.target?.result as string
        }
        reader.readAsDataURL(newAvatar)
    } else if (typeof newAvatar === 'string') {
        mainPersonAvatarPreview.value = newAvatar
    } else {
        mainPersonAvatarPreview.value = ''
    }
}, { immediate: true })

const edgeTypes = {
    special: markRaw(SpecialEdge),
    marriage: markRaw(SpecialEdge),
}

// Let's rename the ref to initialNodes and treat it as static-ish.
const initialNodes = [
    {
        id: 'dad',
        position: { x: 190, y: 170 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'father'
        }
    },
    {
        id: 'mom',
        position: { x: 345, y: 170 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'mother'
        }
    },
    {
        id: 'you',
        position: { x: 265, y: 331 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: props.mainPersonAvatar && typeof props.mainPersonAvatar === 'string' ? props.mainPersonAvatar : '',
            qr_code: '',
            role: 'main_person',
            canAddChild: true,
            isMainPerson: true
        }
    },
    {
        id: 'grandpa_dad',
        position: { x: 75, y: 8 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'grandfather_paternal'
        }
    },
    {
        id: 'grandma_dad',
        position: { x: 200, y: 8 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'grandmother_paternal'
        }
    },
    {
        id: 'grandpa_mom',
        position: { x: 330, y: 8 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'grandfather_maternal'
        }
    },
    {
        id: 'grandma_mom',
        position: { x: 460, y: 8 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'grandmother_maternal'
        }
    },
    {
        id: 'wife',
        position: { x: 155, y: 331 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'spouse'
        }
    },
    {
        id: 'child',
        position: { x: 245, y: 490 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'child'
        }
    },
    {
        id: 'brother',
        position: { x: 375, y: 331 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'sibling',
            canAddBrother: true
        }
    },
    // Кнопки добавления остаются как узлы
    {
        id: 'add-wife-btn',
        position: { x: 45, y: 331 },
        style: { width: '80px', height: '80px' },
        type: 'addButton',
        data: {
            label: 'Add wife',
            isAddButton: true,
            addType: 'wife'
        },
        connectable: false,
    },
    {
        id: 'add-brother-btn',
        position: { x: 485, y: 331 },
        style: { width: '80px', height: '80px' },
        type: 'addButton',
        data: {
            label: 'Add sibling',
            isAddButton: true,
            addType: 'brother'
        },
        connectable: false,
    },
    {
        id: 'add-child-btn',
        position: { x: 355, y: 490 },
        style: { width: '80px', height: '80px' },
        type: 'addButton',
        data: {
            label: 'Add child',
            isAddButton: true,
            addType: 'child'
        },
        connectable: false,
    },
    {
        id: 'other-member-1',
        position: { x: 100, y: 650 },
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: '',
            avatar: '',
            qr_code: '',
            role: 'other'
        }
    },
    {
        id: 'add-other-member-btn',
        position: { x: 215, y: 650 }, // по центру внизу
        style: { width: '60px', height: '80px' },
        type: 'addButton',
        data: {
            label: 'Add member',
            isAddButton: true,
            addType: 'other'
        },
        connectable: false,
    }
]

const initialEdges = [
    {
        id: 'mom-you',
        source: 'mom',
        target: 'you',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'dad-you',
        source: 'dad',
        target: 'you',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'grandma_mom-mom',
        source: 'grandma_mom',
        target: 'mom',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'grandpa_mom-mom',
        source: 'grandpa_mom',
        target: 'mom',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'grandma_dad-dad',
        source: 'grandma_dad',
        target: 'dad',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'grandpa_dad-dad',
        source: 'grandpa_dad',
        target: 'dad',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'you-wife',
        source: 'you',
        target: 'wife',
        type: 'marriage',
        sourcePosition: Position.Left,
        targetPosition: Position.Right,
        sourceHandle: 'source-left',
        targetHandle: 'target-right'
    },
    {
        id: 'you-child',
        source: 'you',
        target: 'child',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
    {
        id: 'mom-brother',
        source: 'mom',
        target: 'brother',
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    },
]

// НОВОЕ: Синхронизация имени главного персонажа
watch(() => props.mainPersonName, (newName) => {
    const youNode = findNode('you')
    if (youNode) {
        updateNode('you', { data: { ...youNode.data, label: newName } })
    } else {
        updateNode('you', { data: { label: newName, isMainPerson: true } })
    }
})

// НОВОЕ: Синхронизация аватара главного персонажа
watch(mainPersonAvatarPreview, (newPreview) => {
    console.log('mainPersonAvatarPreview changed:', newPreview)
    const youNode = findNode('you')
    if (youNode) {
        updateNode('you', { data: { ...youNode.data, avatar: newPreview } })
    } else {
        updateNode('you', { data: { avatar: newPreview, isMainPerson: true } })
    }
})

// Ensure initial update happens after graph is ready
onPaneReady((instance) => {
    console.log('onPaneReady triggered. mainPersonAvatarPreview:', mainPersonAvatarPreview.value)

    // Always update 'you' node to ensure reactivity, even if preview is empty string
    const youNode = findNode('you')
    if (youNode) {
        console.log('Found you node in onPaneReady. Current data:', JSON.parse(JSON.stringify(youNode.data)))

        const newAvatar = mainPersonAvatarPreview.value || (props.mainPersonAvatar && typeof props.mainPersonAvatar === 'string' ? props.mainPersonAvatar : '')

        // Force a new object reference for data to trigger deep watchers
        const newData = {
            ...youNode.data,
            avatar: newAvatar,
            label: props.mainPersonName || youNode.data.label
        }

        updateNode('you', { data: newData })
        console.log('Updated you node in onPaneReady with data:', newData)
    } else {
        console.error('Could not find "you" node in onPaneReady')
    }
})

// Restore Graph Logic
onMounted(() => {
    console.log('FamilyTreeEdit mounted. Initial data:', props.initialData)
    // Ждем инициализации VueFlow? На самом деле useVueFlow вернет методы
    // но если граф еще не готов, updateNode может не работать?
    // Обычно onPaneReady надежнее, но попробуем так.
    // Если nodes инициализируются через v-model или default prop, они могут быть там.

    // ВАЖНО: Мы используем ref nodes, который передаем в VueFlow.
    // Но для обновлений использовать updateNode лучше.

    if (props.initialData && props.initialData.length > 0) {
        restoreGraph(props.initialData)
    }
})

// Watch for changes in initialData (in case it loads after mount)
watch(() => props.initialData, (newData) => {
    console.log('initialData changed:', newData)
    if (newData && newData.length > 0) {
        restoreGraph(newData)
    }
}, { deep: true })

const restoreGraph = (data: any[]) => {
    console.log('Restoring graph with:', data)

    data.forEach((member) => {
        const matchId = member.node_id || member.id

        // Попытка найти существующий узел через nodes.ref (для проверки наличия)
        // Но лучше искать через store, но пока через ref сойдет для определения наличия.
        const existingNode = findNode(matchId)

        console.log(`Processing member: ${member.name} (${member.role}), Match ID: ${matchId}, Found:`, !!existingNode)

        const nodeData = {
            label: member.name,
            avatar: member.avatar && !member.avatar.startsWith('data:')
                ? `/storage/${member.avatar}`
                : member.avatar,
            qr_code: member.qr_code,
            role: member.role
        }

        if (existingNode) {
            // Использование updateNode из useVueFlow
            // ВАЖНО: нужно мержить данные, чтобы не потерять другие поля (например, canAddBrother)
            updateNode(matchId, { data: { ...existingNode.data, ...nodeData } })
            console.log('Updated existing node using updateNode:', matchId)
        } else {
            console.log('Creating new node for:', member.role)
            if (member.role === 'spouse') {
                addNewWife({ id: matchId, position: member.position, data: nodeData })
            } else if (member.role === 'sibling') {
                addNewBrother({ id: matchId, position: member.position, data: nodeData })
            } else if (member.role === 'child') {
                addNewChild({ id: matchId, position: member.position, data: nodeData })
            } else if (member.role === 'other') {
                addNewOtherMember({ id: matchId, position: member.position, data: nodeData })
            }
        }
    })

    // После добавления всех новых узлов через хелперы (которые по-старому пушили в nodes.value),
    // нам, возможно, нужно явно обновить их лейблы, если они не задались сразу?
    // Но хелперы принимают data и создают узел с уже правильным data.

    // Проблема может быть в том, что addNewWife модифицирует nodes.value напрямую.
    // Если useVueFlow используется, лучше добавлять через addNodes.
    // Но пока оставим смешанный режим, так как переписывать все хелперы долго.
    // Главное - обновление существующих узлов (мама, папа, и т.д.) теперь идет через updateNode.
}

// Функция для преобразования узлов в формат для сохранения
const getFamilyMembersData = () => {
    // ВАЖНО: Используем getNodes из useVueFlow, чтобы получить актуальное состояние графа
    // Локальный ref 'nodes' может быть устаревшим после updateNode
    const currentNodes = getNodes.value

    return currentNodes
        .filter(node => !node.data.isAddButton)
        .map(node => ({
            id: node.id,
            name: node.data.label || '',
            role: node.data.role,
            avatar: node.data.avatar || '',
            qr_code: node.data.qr_code || '',
            position: node.position
        }))
        .filter(node => node.id !== 'you')
}

// Отслеживаем изменения в узлах и отправляем данные наверх
// Используем watch на getNodes, чтобы всегда иметь актуальные данные
watch(getNodes, () => {
    const familyData = getFamilyMembersData()
    emit('update:modelValue', familyData)
}, { deep: true })

// Отслеживаем изменения файлов аватаров
watch(avatarFiles, () => {
    emit('update:avatarFiles', avatarFiles.value)
}, { deep: true })

// Обработчик изменения данных узла
const handleNodeDataChange = (nodeId, field, value) => {
    // Используем updateNode для обновления данных в сторе VueFlow
    // Это гарантирует реактивность

    const node = findNode(nodeId)

    // НОВОЕ: Блокируем редактирование для главного персонажа
    if (node?.data.isMainPerson) {
        return
    }

    if (node && !node.data.isAddButton) {
        if (field === 'avatar' && value instanceof File) {
            // Если это File объект, сохраняем его отдельно
            avatarFiles.value.set(nodeId, value)

            // Создаем preview URL для отображения
            const reader = new FileReader()
            reader.onload = (e) => {
                // ВАЖНО: мержим с существующими данными node.data
                updateNode(nodeId, { data: { ...node.data, avatar: e.target?.result as string } })
            }
            reader.readAsDataURL(value)
        } else {
            // Используем computed property names для динамического обновления поля в data
            // ВАЖНО: мержим с существующими данными node.data
            updateNode(nodeId, { data: { ...node.data, [field]: value } })
        }
    }
}

// Остальные функции
function handleAddClick(nodeId) {
    const node = findNode(nodeId)
    if (!node || !node.data.isAddButton) return

    if (node.data.addType === 'brother') {
        addNewBrother()
    } else if (node.data.addType === 'child') {
        addNewChild()
    } else if (node.data.addType === 'wife') {
        addNewWife()
    } else if (node.data.addType === 'other') {
        addNewOtherMember()
    }
}

function addNewOtherMember(restoreData = null) {
    const memberId = restoreData ? restoreData.id : `other-${Date.now()}`
    const addButtonNode = findNode('add-other-member-btn')

    // Safety check
    if (!addButtonNode) return

    // Use restored position or calculate new one
    const position = restoreData && restoreData.position ? restoreData.position : { ...addButtonNode.position }

    const newMember = {
        id: memberId,
        position: position,
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: restoreData ? restoreData.data.label : '',
            avatar: restoreData ? restoreData.data.avatar : '',
            qr_code: restoreData ? restoreData.data.qr_code : '',
            role: 'other'
        }
    }

    let buttonNewX = addButtonNode.position.x
    if (restoreData) {
        // If restoring, we place the node. We should ensure button is to the right of it.
        // But we might restore multiple.
        // Simplest approach: Always sync button position to be to the right of the rightmost 'other' node.
        // But let's stick to the 'Create' logic: when adding, move button.
        buttonNewX = Math.max(buttonNewX, position.x + 110)
    } else {
        buttonNewX += 110
    }

    // Update button position via store
    updateNode(addButtonNode.id, { position: { x: buttonNewX, y: addButtonNode.position.y } })

    // Add new node via store
    addNodes([newMember])
}

function addNewWife(restoreData = null) {
    const wifeId = restoreData ? restoreData.id : `wife-${Date.now()}`
    const addButtonNode = findNode('add-wife-btn')

    if (!addButtonNode) return

    const position = restoreData && restoreData.position ? restoreData.position : { ...addButtonNode.position }

    const newWife = {
        id: wifeId,
        position: position,
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: restoreData ? restoreData.data.label : '',
            avatar: restoreData ? restoreData.data.avatar : '',
            role: 'spouse'
        }
    }

    let buttonNewX = addButtonNode.position.x
    if (restoreData) {
        // Move button to left (min x)
        buttonNewX = Math.min(buttonNewX, position.x - 110)
    } else {
        buttonNewX -= 110
    }

    updateNode(addButtonNode.id, { position: { x: buttonNewX, y: addButtonNode.position.y } })
    addNodes([newWife])

    // Add edge
    addEdges([{
        id: `you-${wifeId}`,
        source: 'you',
        target: wifeId,
        type: 'marriage',
        sourcePosition: Position.Left,
        targetPosition: Position.Right,
        sourceHandle: 'source-left',
        targetHandle: 'target-right'
    }])
}

function addNewBrother(restoreData = null) {
    const brotherId = restoreData ? restoreData.id : `brother-${Date.now()}`
    const addButtonNode = findNode('add-brother-btn')

    if (!addButtonNode) return

    const position = restoreData && restoreData.position ? restoreData.position : { ...addButtonNode.position }

    const newBrother = {
        id: brotherId,
        position: position,
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: restoreData ? restoreData.data.label : '',
            avatar: restoreData ? restoreData.data.avatar : '',
            qr_code: restoreData ? restoreData.data.qr_code : '',
            role: 'sibling'
        }
    }

    let buttonNewX = addButtonNode.position.x
    if (restoreData) {
        buttonNewX = Math.max(buttonNewX, position.x + 110)
    } else {
        buttonNewX += 110
    }

    updateNode(addButtonNode.id, { position: { x: buttonNewX, y: addButtonNode.position.y } })
    addNodes([newBrother])

    addEdges([{
        id: `mom-${brotherId}`,
        source: 'mom',
        target: brotherId,
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    }])
}

function addNewChild(restoreData = null) {
    const childId = restoreData ? restoreData.id : `child-${Date.now()}`

    const addButtonNode = findNode('add-child-btn')
    if (!addButtonNode) return

    const baseX = 245
    const spacing = 110
    let newPosition

    if (restoreData && restoreData.position) {
        newPosition = restoreData.position
    } else {
        // Use getNodes for recalculation
        const existingChildren = getNodes.value.filter(n =>
            n.id.startsWith('child') && !n.data.isAddButton
        )

        if (existingChildren.length === 1) {
            newPosition = { x: baseX - spacing, y: 490 }
        } else {
            const childrenCount = existingChildren.length
            if (childrenCount % 2 === 0) {
                const rightOffset = Math.ceil(childrenCount / 2) * spacing
                newPosition = { x: baseX + rightOffset, y: 490 }
            } else {
                const leftOffset = Math.ceil(childrenCount / 2) * spacing
                newPosition = { x: baseX - leftOffset, y: 490 }
            }
        }
    }

    const newChild = {
        id: childId,
        position: newPosition,
        style: { width: '90px', height: '105px', padding: '5px' },
        data: {
            label: restoreData ? restoreData.data.label : '',
            avatar: restoreData ? restoreData.data.avatar : '',
            qr_code: restoreData ? restoreData.data.qr_code : '',
            role: 'child'
        }
    }

    let buttonNewX = addButtonNode.position.x
    if (restoreData) {
        // Ensure button is moved to the right of the rightmost child
        const rightmostX = Math.max(newPosition.x, ...getNodes.value
            .filter(n => n.id.startsWith('child') && !n.data.isAddButton)
            .map(n => n.position.x))

        buttonNewX = Math.max(buttonNewX, rightmostX + spacing)
    } else {
        // Create logic
        const childNodes = getNodes.value.filter(n => n.id.startsWith('child') && !n.data.isAddButton)
        const rightmostChild = childNodes.length > 0 ? Math.max(...childNodes.map(n => n.position.x)) : baseX
        // fallback to baseline if no children yet, but we are adding one, so actually logic above handles first child.
        // Wait, if existingChildren.length usage above.

        buttonNewX = Math.max(rightmostChild + spacing, newPosition.x + spacing)
    }

    updateNode(addButtonNode.id, { position: { x: buttonNewX, y: addButtonNode.position.y } })
    addNodes([newChild])

    addEdges([{
        id: `you-${childId}`,
        source: 'you',
        target: childId,
        type: 'special',
        sourcePosition: Position.Bottom,
        targetPosition: Position.Top,
        sourceHandle: 'source-bottom',
        targetHandle: 'target-top'
    }])
}

// Экспортируем функцию для получения данных семьи
defineExpose({
    getFamilyMembersData,
    getAvatarFiles: () => avatarFiles.value
})

// Animation directive
const vScrollAnimate = {
    mounted(el: HTMLElement, binding: any) {
        const { delay = 0, direction = 'up', offset = 100 } = binding.value || {}
        el.style.opacity = '0'
        el.style.transition = 'all 0.6s ease-out'
        switch (direction) {
            case 'up': el.style.transform = 'translateY(30px)'; break
            case 'down': el.style.transform = 'translateY(-30px)'; break
            case 'left': el.style.transform = 'translateX(-30px)'; break
            case 'right': el.style.transform = 'translateX(30px)'; break
        }
        if (delay > 0) el.style.transitionDelay = `${delay}ms`

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            (entry.target as HTMLElement).style.opacity = '1'
                                ; (entry.target as HTMLElement).style.transform = 'translate(0, 0)'
                        }, delay)
                        observer.unobserve(entry.target)
                    }
                })
            },
            { root: null, rootMargin: `0px 0px -${offset}px 0px`, threshold: 0.1 }
        )
        observer.observe(el)
            ; (el as any)._observer = observer
    },
    unmounted(el: any) {
        if (el._observer) el._observer.disconnect()
    }
}
</script>

<template>
    <div class="flex min-h-screen flex-col items-center p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <div class="text-center space-y-5 mx-auto mt-0 md:mt-[7px]">
            <p class="text-muted-foreground max-w-xl mx-auto px-3 sm:px-1">
                Here you can add a family member by entering their name and uploading their photo.
                You can easily manage and update family members at any time.
            </p>
        </div>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <div style="width: 100%; " class="h-[500px] md:h-[800px] lg:h-[1000px]">
                <VueFlow :nodes="initialNodes" :edges="initialEdges" fit-view-on-init :edge-types="edgeTypes"
                    v-scroll-animate="{ direction: 'up', offset: 200 }" :zoom-on-scroll="false" :zoom-on-pinch="false"
                    :zoom-on-double-click="false" :pan-on-drag="false" :nodes-draggable="false"
                    :nodes-connectable="false" :elements-selectable="false"
                    @node-click="(event) => handleAddClick(event.node.id)">
                    <template #node-default="nodeProps">
                        <SpecialNodeEdit v-bind="nodeProps" class="shadow-xs"
                            @update-node-data="handleNodeDataChange" />
                    </template>

                    <template #node-addButton="nodeProps">
                        <div class="flex flex-col items-center justify-start w-full h-full cursor-pointer"
                            @click.stop="handleAddClick(nodeProps.id)">
                            <div style="margin-top: 45px;"
                                class="w-7 h-7 rounded-full bg-blue-500 hover:bg-blue-600 flex items-center justify-center shadow-md transition-transform duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-1">
                                <span class="text-white text-lg">+</span>
                            </div>
                            <span class="mt-2 text-xs text-gray-700 dark:text-gray-300 text-center px-1 leading-tight">
                                {{ nodeProps.data.label }}
                            </span>
                        </div>
                    </template>

                    <Controls />
                </VueFlow>
            </div>
        </div>
    </div>
</template>

<style scoped>
.special-node {
    font-size: 14px;
    cursor: pointer;
    transition: border 0.3s ease;
    border-color: aqua;
}

.vue-flow-container {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.vue-flow-main {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
}
</style>
