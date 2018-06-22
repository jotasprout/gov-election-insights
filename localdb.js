const dbPromise = idb.open('testdb', 1, upgradeDB => {
    const keyValStore = upgradeDB.createObjectStore('testdb');
    keyValStore.put ('douche', 'trump');
});

