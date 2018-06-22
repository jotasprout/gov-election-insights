const dbPromise = idb.open('testdb', 1, upgradeDB => {
    const keyValStore = upgradeDB.createObjectStore('testdb');
    keyValStore.put ('douche', 'trump');
});

dbPromise.then (db => {
    const tx = db.transaction ('testdb');
    const testStore = tx.objectStore('testdb');
    return testStore.get('trump');
}).then (val => {
    console.log ('The value of "trump" is: ', val);
});

dbPromise.then (db => {
    const tx = db.transaction('testdb', 'readwrite');
    const testStore = tx.objectStore('testdb');
    testStore.put('douche-lite', 'clinton');
    return tx.complete;
}).then (function(){
    console.log('Added clinton:douche-lite to testdb');
});