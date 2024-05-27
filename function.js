function sortTable(column) {
    const url = new URL(window.location.href);
    const sort = url.searchParams.get('sort') === 'asc' ? 'desc' : 'asc';
    url.searchParams.set('sort', sort);
    url.searchParams.set('column', column);
    window.location.href = url.href;
}

function changeTable(table) {
    const url = new URL(window.location.href);
    url.searchParams.set('table', table);
    window.location.href = url.href;
}