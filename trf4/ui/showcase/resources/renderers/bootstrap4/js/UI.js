import axios from 'axios';

"use strict";
//todo refatorar isso para algo mais elegante

// retorna valor do campo select|checkbox que ativa campo relacionado true|false, onde campo o preenchido retorna true
function shouldActivate(element) {
    if (element.tagName == 'SELECT') {
        return (element.value.length > 0);
    } else {
        return element.checked;
    }
}

export const UI = {
    defaults: {
        locale: 'pt-br',
        dateHourMinFormat: 'DD/MM/YYYY HH:mm',
        dateFormat: 'DD/MM/YYYY',
        hourMinFormat: 'HH:mm',
    },
    PHPHelper: {
        dateInterval: {
            init(startId, endId, withTime) {
                UI.PHPHelper.date.init(startId, withTime);
                UI.PHPHelper.date.init(endId, withTime);

                const dateStart = $('#' + startId);
                const dateEnd = $('#' + endId);

                dateStart.on("change.datetimepicker", function (e) {
                    const minDate = dateStart.val() ? e.date : false;
                    dateEnd.datetimepicker('minDate', minDate);
                });

                dateEnd.on("change.datetimepicker", function (e) {
                    const maxDate = dateEnd.val() ? e.date : false;
                    dateStart.datetimepicker('maxDate', maxDate);
                });
            }
        },
        date: {
            /**
             *
             * @param id string
             * @param withTime boolean
             * @param value = null string
             */
            init(id, withTime, value) {

                const input = $('#' + id);

                let options = withTime ? {} : {format: 'L'};

                const format = withTime ? UI.defaults.dateHourMinFormat : UI.defaults.dateFormat;

                if (value) {
                    options.defaultDate = moment(value, format);
                }

                input.datetimepicker(options);

                const blocks = {
                    DD: {
                        mask: IMask.MaskedRange,
                        from: 1,
                        to: 31
                    },
                    MM: {
                        mask: IMask.MaskedRange,
                        from: 1,
                        to: 12
                    },
                    YYYY: {
                        mask: IMask.MaskedRange,
                        from: '0000',
                        to: '9999'
                    }
                };

                if (withTime) {
                    blocks.HH = {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 23
                    };

                    blocks.mm = {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 59
                    };
                }

                const placeholder = input.attr('placeholder');

                function newMask(lazy) {
                    return IMask(document.getElementById(id), {
                        mask: Date,
                        pattern: format,
                        lazy: lazy,
                        format: function (date) {
                            return moment(date).format(format);
                        },
                        parse: function (str) {
                            return moment(str, format);
                        },
                        blocks: blocks
                    });
                }

                let momentMask = newMask(true);
                const formatPlaceholder = format.replace(/[A-Z]/g, "_");

                input.on('click', function (e) {
                    momentMask.destroy();
                    momentMask = newMask(false);
                    if (input.val() === formatPlaceholder) {
                        input[0].setSelectionRange(0, 0);
                    }
                });

                input.on('focusout', function (e) {
                    momentMask.destroy();
                    momentMask = newMask(true);
                    input.attr('placeholder', placeholder);
                });

                input.on('change.datetimepicker', function (e) {
                    if (input.val() === formatPlaceholder) {
                        input.datetimepicker('clear');
                        input.val('')
                    }
                    momentMask.updateValue();
                    return false;
                });
            }
        },
        time: {
            /**
             *
             * @param id string
             * @param amPm boolean
             * @param value = null string
             */
            init(id, amPm, value) {

                const input = $('#' + id);
                let options = {};
                options.format = (amPm ? 'HH:mm A' : 'HH:mm');

                const format = options.format;

                if (value) {
                    options.defaultDate = moment(value, format);
                }

                input.datetimepicker(options);

                const blocks = {
                    HH: {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 23
                    },
                    mm: {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 59
                    }
                };

                const placeholder = input.attr('placeholder');

                function newMask(lazy) {
                    return IMask(document.getElementById(id), {
                        mask: Date,
                        pattern: format,
                        lazy: lazy,
                        format: function (date) {
                            return moment(date).format(format);
                        },
                        parse: function (str) {
                            return moment(str, format);
                        },
                        blocks: blocks
                    });
                }

                let momentMask = newMask(true);


                input.on('click', function (e) {
                    momentMask.destroy();
                    momentMask = newMask(false);
                });

                input.on('focusout', function (e) {
                    momentMask.destroy();
                    momentMask = newMask(true);
                    input.attr('placeholder', placeholder);
                });

                input.on('change.datetimepicker', function (e) {
                    momentMask.updateValue();
                    return false;
                });
            }
        },
        addActivatedBy: (targetId, activatorId) => {
            const activator = document.getElementById(activatorId);
            const target = document.getElementById(targetId);
            const dataAttr = 'uiActivates';

            const isChecked = shouldActivate(activator);
            activator.dataset[dataAttr] = targetId;

            const handleChange = (e) => {
                const activator = e.target;
                const targetId = activator.dataset[dataAttr];
                const isChecked = shouldActivate(activator);
                const target = $('#' + targetId);
                checkActivation(target, isChecked);
            }

            const checkActivation = (target, isChecked) => {
                target.prop('disabled', !isChecked);
                target.selectpicker('refresh');
            }

            activator.addEventListener('change', handleChange);
            checkActivation($(target), isChecked);
        },
        select: {
            init: (id, feedbackContainerHtml) => {
                const select = $('#' + id);
                select.selectpicker();
                select.parent().append(feedbackContainerHtml);
            },

            addDependency: (dependencyName,
                            inputId,
                            spinnerPlaceholder,
                            childId,
                            callbackMethod,
                            url,
                            paramsFn,
                            placeholder,
                            placeholderIfNull,
                            valueAttrFn,
                            innerHTMLAttrFn,
                            dataMap,
                            shouldTriggerSelectOnChange) => {

                //todo formatar o resultado (nao posso garantir que vai ser sempre innerHTML, value e data

                //todo quem gera isso é o pai né... assim vai ter duplicatas no caso de mais de um elemento dependente
                function getSelectCountriesData(el) {
                    var selectedOption = el.selectedOptions[0];

                    return {
                        innerHTML: selectedOption.innerHTML,
                        value: selectedOption.value,
                        data: selectedOption.dataset
                    };
                }

                function addOptionsToSelect(placeholder, select, setOptions, dataMap, valueAttr, innerHTMLAttr) {
                    var optionsHTML = `<option value=''>${placeholder}</option>`;

                    setOptions.forEach(function (v, k) {
                        var value = valueAttr(k, v);
                        var innerHTML = innerHTMLAttr(k, v);
                        var dataset = [];
                        Object.getOwnPropertyNames(dataMap).forEach(function (returnAttr, optionAttr) {
                            var returnValue = o[returnAttr];
                            dataset.push(optionAttr + '="' + returnValue + '"');
                        });

                        var optionAttrsString = dataset.join(' ');

                        optionsHTML += '<option value="' + value + '" ' + optionAttrsString + '>' + innerHTML + '</option>';
                    });

                    select.innerHTML = optionsHTML;
                    //select.disabled = false;
                    $("#" + select.id).selectpicker('refresh');
                }

                function setChildSelectDisabled(placeholder, child) {
                    child.disabled = true;
                    addOptionsToSelect(placeholder, child, []);
                }

                function clearSelect(el) {
                    el.disabled = true;
                    el.innerHTML = '';
                    $("#" + el.id).selectpicker('refresh');
                }

                function showSpinner(spinner) {
                    spinner.style = '';
                }

                function hideSpinner(spinner) {
                    spinner.style = 'display:none;';
                }

                function clearFeedbackMessage(feedbackMessage) {
                    feedbackMessage.html('');
                    feedbackMessage.hide();
                }

                function setFeedbackMessage(feedbackMessage, message) {
                    feedbackMessage.html(message);
                    feedbackMessage.show();
                }

                $('#' + inputId).change(function () {
                    var select = this;
                    var data = getSelectCountriesData(select);
                    var param = data.innerHTML;
                    const childEl = document.getElementById(childId);
                    const feedbackMessage = $('#' + childEl.id + '-feedbackMessage')

                    clearSelect(childEl);
                    clearFeedbackMessage(feedbackMessage);

                    var spinner = document.getElementById(spinnerPlaceholder)

                    if (select.value) {

                        showSpinner(spinner);

                        axios[callbackMethod](url, paramsFn())
                            .then(function (data) {
                                childEl.disabled = false;
                                addOptionsToSelect(placeholder, childEl, data.data, dataMap, valueAttrFn, innerHTMLAttrFn);
                            })
                            .catch(function (error) {
                                setFeedbackMessage(feedbackMessage, error);
                                console.error(error);
                            })
                            .finally(function () {
                                hideSpinner(spinner);
                            });

                    } else {

                        setChildSelectDisabled(placeholderIfNull, childEl);
                    }
                });

                if (shouldTriggerSelectOnChange) {
                    $('#' + inputId).change();
                }
            },
        }

    },
    __tagify_obj: {},
    multiAutocomplete: {
        init(id, tags, inputNamePrefix, isMultiple, dataSource, minChars) {

            addValidationHandlers(id);


            let idTags = id,
                input = document.getElementById(idTags),
                idSelectAll = id + '-listAll',
                controller,
                newTags = null,
                sourceUrl = dataSource.url,
                innerHTMLAttrFn = dataSource.labelFormatFn,
                valueFormatFn = dataSource.valueFormatFn;

            if (tags) {
                newTags = reformatWhitelist(tags);
            }

            let tagifyOptions = {
                enforceWhitelist: true,
                whitelist: newTags,
                delimiters: null,
                editTags: 0,
                addTagOnBlur: false,
                templates: {
                    tag(tagData) {
                        const inputs = createInputElementsFromTagData(tagData);

                        return `<tag title="${(tagData.title || tagData.value)}"
                          contenteditable='false'
                          spellcheck='false'
                          tabIndex="0"
                          class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                          ${this.getAttributes(tagData)}>
                            <button type="button" title='Remover' class="p-2 btn btn-link ${this.settings.classNames.tagX}" role='button' aria-label='remove tag'></button>
                            <div>
                            <span class="${this.settings.classNames.tagText}">${(tagData.title || tagData.value)}</span>
                            </div>
                            ${inputs}
                        </tag>`
                    }
                },
                dropdown: {
                    maxItems: Infinity,
                    classname: "color-blue",
                    enabled: minChars
                }
            }


            if (!isMultiple) {
                tagifyOptions.mode = 'select';
            }

            var tagify = new Tagify(input, tagifyOptions);
            UI.__tagify_obj[id] = {tagify, reformatWhitelist};

            tagify.on('blur', (e) => {
                return false;
            });
            tagify.on('input', resetWhitelist);
            tagify.on('input', debounce(onInput, 400));

            $("#" + idSelectAll).click(function () {
                tagify.DOM.input.innerHTML = '';
                doFetch(null);
            });


            if (newTags) {
                tagify.addTags(newTags);
            }

            function onInput(e) {
                var value = e.detail.value;
                if (value.length >= minChars) {
                    console.log('fetching...');
                    doFetch(value);
                }
            }

            function resetWhitelist() {
                console.log('reset');
                tagify.whitelist = null; // reset the whitelist
                tagify.dropdown.refilter();
                tagify.dropdown.hide(true);
            }

            function doFetch(value) {

                resetWhitelist();

                controller && controller.abort();
                // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
                controller = new AbortController();

                // show loading animation and hide the suggestions dropdown

                let valueString = '';

                let options = {
                    method: dataSource.method,
                    signal: controller.signal
                };

                if (value === '') {
                    tagify.loading(false)
                    return;
                }

                tagify.loading(true);

                if (dataSource.method == 'post') {
                    //options.headers = {'Content-Type': 'application/x-www-form-urlencoded'};
                    let params = new URLSearchParams();
                    params.set('q', value);
                    options.body = params;
                } else {
                    valueString = value !== null ? ((sourceUrl.indexOf('?') !== -1 ? '&' : '?') + 'q=' + value) : '';
                }

                fetch(sourceUrl + valueString, options)
                    .then(res => res.json())
                    .then(function (whitelist) {
                        tagify.whitelist = reformatWhitelist(whitelist);
                        tagify
                            .loading(false)
                            .dropdown.show(null); // render the suggestions dropdown
                    });
            }

            function createInputElementsFromTagData(tagData) {
                var inputKey = valueFormatFn(tagData.key, tagData.data);

                let inputs;
                const data = tagData.data;
                if (tagData.isObject === true) {
                    inputs = createInput(`${inputNamePrefix}_map[${tagData.key}]`, tagData.value);
                } else if (isObject(data)) {
                    inputs = Object.entries(data)
                        .map(v => createInput(`${inputNamePrefix}[${inputKey}][${v[0]}]`, v[1]))
                        .join(' ');
                } else { //string
                    inputs = createInput(`${inputNamePrefix}[${data}]`, '');
                }

                return inputs;

            }

            function createInput(name, value) {
                return `<input type="hidden" name="${name}" value="${value}"/>\n`;
            }

            function addValidationHandlers(id) {
                document.getElementById(id).addEventListener('invalid', function () {
                    this.previousSibling.classList.remove('is-valid');
                    this.previousSibling.classList.add('is-invalid');
                })

                document.getElementById(id).addEventListener('change', function () {
                    if (this.checkValidity()) {
                        this.previousSibling.classList.add('is-valid');
                        this.previousSibling.classList.remove('is-invalid');
                    }
                })
            }

            function reformatWhitelist(whitelist) {

                var newWhitelist = [];

                if (isObject(whitelist)) { // k => v map
                    for (const [k, v] of Object.entries(whitelist)) {
                        newWhitelist.push({
                            key: k,
                            isObject: true,
                            value: innerHTMLAttrFn(k, v), //used by Tagify exclusively
                            data: v
                        });
                    }
                } else { //array of strings OR array of objects
                    whitelist.forEach(function (v, k) {
                        newWhitelist.push({
                            key: k,
                            isObject: false,
                            value: innerHTMLAttrFn(k, v),
                            data: v
                        });
                    });
                }
                return newWhitelist;
            }

            // bind "DragSort" to Tagify's main element and tell
            // it that all the items with the below "selector" are "draggable"
            var dragsort = new DragSort(tagify.DOM.scope, {
                selector: '.' + tagify.settings.classNames.tag,
                callbacks: {
                    dragEnd: onDragEnd
                }
            })

            // must update Tagify's value according to the re-ordered nodes in the DOM
            function onDragEnd(elm) {
                tagify.updateValueByDOMTags();
            }

        },
        defaultLabelInnerHtmlFormat: function (k, v) {
            return isObject(v) ? Object.values(v).join(' - ') : v;
        },
        defaultValueFormat: function (k, v) {
            return k ? k : (isObject(v) ? null : v);
        },
        addTags(id, tags) {
            const {tagify, reformatWhitelist} = UI.__tagify_obj[id], length = tags.length;
            tags = reformatWhitelist([...tags, ...tagify.whitelist.map(t => t.data)]);
            tagify.whitelist = tags;
            tagify.addTags(tags.slice(0, length));
        }
    }
}

function debounce(fn, wait) {
    var timeout;
    return function () {
        var context = this;
        var args = arguments;

        clearTimeout(timeout);

        timeout = setTimeout(function () {
            fn.apply(context, args);
        }, wait);
    };
};

function isObject(obj) {
    return obj != null && obj.constructor.name === "Object"
}

export default UI;
