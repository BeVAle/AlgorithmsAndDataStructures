document.querySelector('.stack_push').onclick = function () {
    let stackBegin =document.querySelector("#stack_begin");
    let stackFinish = document.querySelector("#stack_finish");
    stackFinish.value = stackBegin.value+ " " + stackFinish.value;
};

document.querySelector('.stack_pop').onclick = function () {
    let stackBegin =document.querySelector("#stack_begin");
    let stackFinish = document.querySelector("#stack_finish");
    let stack = stackFinish.value.split(' ');
    stackBegin.value = stack[0];
    delete stack[0];
    stackFinish.value = stack.join(' ').trim();
};


document.querySelector('.queue_push').onclick = function () {
    let queueBegin =document.querySelector("#queue_begin");
    let queueFinish = document.querySelector("#queue_finish");
    queueFinish.value = queueBegin.value+ " " + queueFinish.value;
};

document.querySelector('.queue_pop').onclick = function () {
    let queueBegin =document.querySelector("#queue_begin");
    let queueFinish = document.querySelector("#queue_finish");
    let queue = queueFinish.value.split(' ');
    queueBegin.value = queue[queue.length - 1];
    delete queue[queue.length - 1];
    queueFinish.value = queue.join(' ').trim();
};